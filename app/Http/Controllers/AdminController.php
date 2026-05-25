<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $totalServices = Service::count();
        $totalOrders = Order::count();
        $totalClients = User::where('role', User::ROLE_CLIENT)->count();
        $totalFreelancers = User::where('role', User::ROLE_FREELANCER)->count();
        $recentDraftServices = Service::where('status', 'draft')->with('freelancer')->latest()->take(5)->get();
        $recentPendingOrders = Order::whereIn('status', ['pending', 'in progress'])->with('service', 'client', 'freelancer')->latest()->take(5)->get();
        $recentOrders = $recentDraftServices->concat($recentPendingOrders)->sortByDesc('created_at')->take(5);

        return view('admin.dashboard', compact(
            'totalServices',
            'totalOrders',
            'totalClients',
            'totalFreelancers',
            'recentOrders'
        ));
    }

    public function services(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = Service::with('freelancer');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhereHas('freelancer', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $services = $query->latest()->paginate(18)->withQueryString();

        // Stats for the page
        $totalServices = Service::count();
        $publishedServices = Service::where('status', 'published')->count();
        $draftServices = Service::where('status', 'draft')->count();
        $rejectedServices = Service::where('status', 'rejected')->count();

        return view('admin.services.index', compact('services', 'totalServices', 'publishedServices', 'draftServices', 'rejectedServices'))->with('highlightId', $request->highlight);
    }

    public function orders(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = Order::with('service', 'client', 'freelancer');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhereHas('client', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('freelancer', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('service', function ($q) use ($request) {
                        $q->where('title', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $orders = $query->latest()->paginate(18)->withQueryString();

        // Stats for the page
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        return view('admin.orders.index', compact('orders', 'totalOrders', 'totalRevenue', 'pendingOrders', 'completedOrders'))->with('highlightId', $request->highlight);
    }

    public function showOrder(Order $order)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $order->load('service', 'client', 'freelancer', 'review');
        return view('admin.orders.show', compact('order'));
    }

    public function exportOrders()
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $month = now()->format('F-Y');
        $filename = "report-order-{$month}.xlsx";

        $orders = \App\Models\Order::with(['client', 'freelancer'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('amount', '>', 0)
            ->latest()
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title
        $sheet->setCellValue('A1', 'Order Report - ' . now()->format('F Y'));
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

        // Headers (row 3)
        $headers = ['Order ID', 'Client Name', 'Freelancer Name', 'Original Price', 'Platform Fee', 'Amount', 'Status', 'Payment Status', 'Date'];
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        foreach ($headers as $index => $header) {
            $cell = $sheet->getCell($columns[$index] . '3');
            $cell->setValue($header);
            $cell->getStyle()->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
            $cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('4F46E5');
            $cell->getStyle()->getAlignment()->setHorizontal('center')->setVertical('center');
        }

        // Set header row height
        $sheet->getRowDimension(3)->setRowHeight(30);

        // Data starting from row 4
        $row = 4;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order->id);
            $sheet->setCellValue('B' . $row, $order->client->name ?? 'N/A');
            $sheet->setCellValue('C' . $row, $order->freelancer->name ?? 'N/A');
            $sheet->setCellValue('D' . $row, $order->original_price ?? 0);
            $sheet->setCellValue('E' . $row, $order->platform_fee ?? 0);
            $sheet->setCellValue('F' . $row, $order->amount);
            $sheet->setCellValue('G' . $row, ucfirst($order->status));
            $sheet->setCellValue('H' . $row, $order->payment_status === 'paid' ? 'Paid' : 'Unpaid');
            $sheet->setCellValue('I' . $row, $order->created_at->setTimezone('Asia/Bangkok')->format('Y-m-d H:i'));

            // Center align all data cells
            foreach ($columns as $col) {
                $sheet->getCell($col . $row)->getStyle()->getAlignment()->setHorizontal('center')->setVertical('center');
            }
            $row++;
        }

        // Set minimum column width + auto size
        $minWidths = ['A' => 12, 'B' => 20, 'C' => 20, 'D' => 15, 'E' => 15, 'F' => 15, 'G' => 15, 'H' => 15, 'I' => 18];
        foreach ($minWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // Add borders
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A3:I' . ($row - 1))->applyFromArray($styleArray);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function users(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(18)->withQueryString();

        // Stats for the page
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalClients = User::where('role', User::ROLE_CLIENT)->count();
        $totalFreelancers = User::where('role', User::ROLE_FREELANCER)->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'activeUsers', 'totalClients', 'totalFreelancers'));
    }

    public function showUser(User $user)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Load relationships
        $user->load(['services', 'orders']);

        return view('admin.users.show', compact('user'));
    }

    public function createUser()
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:client,freelancer,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function createService()
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $freelancers = User::where('role', User::ROLE_FREELANCER)->where('is_active', true)->get();

        return view('admin.services.create', compact('freelancers'));
    }

    public function storeService(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'pricing_type' => 'required|in:fixed,hourly,project',
            'category' => 'required|string|max:255',
            'freelancer_id' => 'required|exists:users,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['status'] = 'published'; // Admin created services are published by default

        // Pricing columns
        $data['original_price'] = $data['price'];
        $data['platform_fee'] = $data['price'] * 0.15;

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('services', 'public');
            $data['image_path'] = $path;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function destroyUser(User $user)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Prevent admin from deactivating themselves
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Admin cannot deactivate yourself.');
        }

        // Instead of deleting, we deactivate the user
        $user->update(['is_active' => false]);

        return redirect()->route('admin.users.index')->with('success', 'User has been deactivated successfully.');
    }

    public function reactivateUser(User $user)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Reactivate the user
        $user->update(['is_active' => true]);

        return redirect()->route('admin.users.index')->with('success', 'User has been reactivated successfully.');
    }
}

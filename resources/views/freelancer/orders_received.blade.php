<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Orders - Freelancer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-slate-900 min-h-screen text-white hidden md:block sticky top-0">
        <div class="p-6 text-2xl font-bold border-b border-slate-800">
            <span class="text-indigo-400">FreelanceHub</span>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ url('/freelancer/dashboard') }}" class="flex items-center space-x-3 hover:bg-slate-800 p-3 rounded-lg transition">
                <i class="fas fa-chart-line"></i><span>Dashboard</span>
            </a>
            <a href="{{ url('/freelancer/services') }}" class="flex items-center space-x-3 hover:bg-slate-800 p-3 rounded-lg transition">
                <i class="fas fa-concierge-bell"></i><span>Manage Services</span>
            </a>
            <a href="{{ url('/freelancer/orders') }}" class="flex items-center space-x-3 bg-indigo-600 p-3 rounded-lg">
                <i class="fas fa-tasks"></i><span>Received Orders</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-800">Orders Management</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-500">Seller Mode</span>
                <img src="https://ui-avatars.com/api/?name=Sarah+Chen&background=6366f1&color=fff" class="w-8 h-8 rounded-full">
            </div>
        </header>

        <main class="p-8">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Manage Orders</h1>
                    <p class="text-gray-500 mt-1">Accept requirements and deliver your work to clients.</p>
                </div>

                <div class="space-y-6">
                    @php
                        $receivedOrders = [
                            [
                                'id' => 'ORD-9921',
                                'client' => 'John Doe',
                                'service' => 'Responsive Web App with Laravel',
                                'price' => 500,
                                'status' => 'Pending',
                                'requirements' => 'I need a dashboard for my coffee shop inventory. Must include a dark mode and export to CSV feature.',
                                'date' => '2 hours ago'
                            ],
                            [
                                'id' => 'ORD-9850',
                                'client' => 'Jane Smith',
                                'service' => 'API Integration Specialist',
                                'price' => 150,
                                'status' => 'In Progress',
                                'requirements' => 'Integrate Stripe payment gateway into my existing custom PHP site.',
                                'date' => '1 day ago'
                            ]
                        ];
                    @endphp

                    @foreach($receivedOrders as $order)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex flex-wrap justify-between items-center gap-4 bg-gray-50/50">
                            <div class="flex items-center gap-3">
                                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-1 rounded">#{{ $order['id'] }}</span>
                                <h3 class="font-bold text-gray-900">{{ $order['service'] }}</h3>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-xs text-gray-400 uppercase font-bold">Earnings</p>
                                    <p class="font-bold text-gray-900">${{ $order['price'] }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $order['status'] == 'Pending' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $order['status'] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ $order['client'] }}" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-800">{{ $order['client'] }} <span class="text-xs font-normal text-gray-500 ml-2">{{ $order['date'] }}</span></p>
                                    <div class="mt-3 p-4 bg-gray-50 rounded-lg border border-gray-100 italic text-gray-600 text-sm">
                                        "{{ $order['requirements'] }}"
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                            @if($order['status'] == 'Pending')
                                <form action="{{ url('/freelancer/orders/update-status/'.$order['id']) }}" method="POST">
                                    @csrf
                                    <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-100 transition">
                                        Decline
                                    </button>
                                    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition ml-2">
                                        Accept & Start Work
                                    </button>
                                </form>
                            @elseif($order['status'] == 'In Progress')
                                <button class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition">
                                    Deliver Completed Work
                                </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

</body>
</html>

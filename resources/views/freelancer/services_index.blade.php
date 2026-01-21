<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Services - FreelanceHub</title>
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
            <a href="{{ url('/freelancer/services') }}" class="flex items-center space-x-3 bg-indigo-600 p-3 rounded-lg">
                <i class="fas fa-concierge-bell"></i><span>Manage Services</span>
            </a>
            <a href="{{ url('/freelancer/orders') }}" class="flex items-center space-x-3 hover:bg-slate-800 p-3 rounded-lg transition">
                <i class="fas fa-tasks"></i><span>Received Orders</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-800">My Services</h2>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/freelancer/services/create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-indigo-700 transition">
                    + Create New Service
                </a>
            </div>
        </header>

        <main class="p-8">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Manage Services</h1>
                    <p class="text-gray-500 mt-1">View, edit, or remove your published services.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 text-xs uppercase font-bold border-b border-gray-200">
                                    <th class="px-6 py-4">Service Details</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $myServices = [
                                        ['id' => 1, 'title' => 'Responsive Web App with Laravel', 'category' => 'Programming', 'price' => 500, 'status' => 'Active'],
                                        ['id' => 2, 'title' => 'API Integration Specialist', 'category' => 'Web Dev', 'price' => 150, 'status' => 'Draft'],
                                        ['id' => 3, 'title' => 'Database Optimization', 'category' => 'Database', 'price' => 200, 'status' => 'Active'],
                                    ];
                                @endphp

                                @foreach($myServices as $service)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-indigo-100 rounded flex items-center justify-center text-indigo-600">
                                                <i class="fas fa-laptop-code"></i>
                                            </div>
                                            <span class="font-bold text-gray-800">{{ $service['title'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $service['category'] }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        ${{ $service['price'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($service['status'] == 'Active')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Active</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Draft</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ url('/freelancer/services/edit/'.$service['id']) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="{{ url('/freelancer/services/delete/'.$service['id']) }}" class="text-red-500 hover:text-red-700 text-sm font-bold ml-4" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(count($myServices) == 0)
                <div class="text-center py-20 bg-white rounded-xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-plus-circle text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-bold text-gray-800">No services yet</h3>
                    <p class="text-gray-500 mb-6">Start by creating your first service to show clients what you can do.</p>
                    <a href="{{ url('/freelancer/services/create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold">Create Service</a>
                </div>
                @endif
            </div>
        </main>
    </div>

</body>
</html>

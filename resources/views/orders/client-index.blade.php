<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Orders (Client)') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="font-semibold">{{ $orders->count() }}</span>
                <span>{{ $orders->count() === 1 ? 'Order' : 'Orders' }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity class="flex items-center p-4 mb-6 text-emerald-800 border-l-4 border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-r-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('status') }}</span>
                    <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            @if(request('paid') === 'success')
                <div x-data="{ show: true }" x-show="show" x-transition.opacity class="flex items-center p-4 mb-6 text-emerald-800 border-l-4 border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-r-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">Payment successful! Thank you. Your order is now paid.</span>
                    <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        My Placed Orders
                    </h3>
                </div>

                @if($orders->count() > 0)
                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Order ID
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Freelancer
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Service
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Amount
                                    </th>
                                     <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                         Status
                                     </th>
                                     <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                         Payment Status
                                     </th>
                                     <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                         Order Date
                                     </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors duration-150">
                                        <!-- Order ID -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                    <span class="text-white font-bold text-sm">#{{ $order->id }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Freelancer -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($order->freelancer->profile_picture)
                                                    <img src="{{ str_starts_with($order->freelancer->profile_picture, 'http') ? $order->freelancer->profile_picture : asset('storage/' . $order->freelancer->profile_picture) }}" alt="{{ $order->freelancer->name }}" class="w-10 h-10 rounded-full object-cover mr-3 border-2 border-indigo-500">
                                                @else
                                                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold mr-3">
                                                        {{ substr($order->freelancer->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        {{ $order->freelancer->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $order->freelancer->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Service -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center max-w-xs">
                                                @if($order->service->image_path || $order->service->image_url)
                                                    <div class="w-12 h-12 rounded-lg overflow-hidden mr-3 flex-shrink-0">
                                                        @if($order->service->image_path)
                                                            <img src="{{ asset('storage/' . $order->service->image_path) }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover">
                                                        @elseif($order->service->image_url)
                                                            <img src="{{ $order->service->image_url }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover">
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="min-w-0 flex-1">
                                                    <a href="{{ route('services.show', $order->service) }}" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition truncate block">
                                                        {{ $order->service->title }}
                                                    </a>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                        {{ Str::limit($order->service->description, 50) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Amount -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-lg font-black text-emerald-600 dark:text-emerald-400">
                                                ${{ number_format($order->amount, 2) }}
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
                                                {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' :
                                                   ($order->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300' :
                                                   ($order->status === 'in progress' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' :
                                                   'bg-gray-100 text-gray-700 dark:bg-gray-900/40 dark:text-gray-300')) }}">
                                                <span class="w-2 h-2 rounded-full mr-2 {{ $order->status === 'completed' ? 'bg-emerald-500' : ($order->status === 'pending' ? 'bg-amber-500' : ($order->status === 'in progress' ? 'bg-blue-500' : 'bg-gray-500')) }}"></span>
                                                {{ $order->status }}
                                            </span>
                                         </td>
 
                                         <!-- Payment Status -->
                                         <td class="px-6 py-4 whitespace-nowrap">
                                             @if($order->payment_status === 'paid')
                                                 <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                     <span class="w-2 h-2 rounded-full mr-2 bg-emerald-500"></span>
                                                     Paid
                                                 </span>
                                             @else
                                                 <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300">
                                                     <span class="w-2 h-2 rounded-full mr-2 bg-amber-500"></span>
                                                     Unpaid
                                                 </span>
                                             @endif
                                         </td>
 
                                         <!-- Order Date -->
                                         <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                {{ $order->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $order->created_at->format('h:i A') }}
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('chat.show', $order) }}"
                                                   class="inline-flex items-center px-3 py-2 text-xs font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow-sm hover:shadow-md"
                                                   title="Chat with {{ $order->freelancer->name }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                </a>
                                                 <a href="{{ route('orders.show', $order) }}"
                                                    class="inline-flex items-center px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition shadow-sm hover:shadow-md"
                                                    title="View Details">
                                                     View Details
                                                 </a>

                                                 @if($order->payment_status !== 'paid' && !in_array($order->status, ['pending', 'completed', 'cancelled']))
                                                     <a href="{{ route('orders.pay', $order) }}"
                                                        class="inline-flex items-center px-4 py-2 text-xs font-black text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 rounded-lg shadow-md transition"
                                                        title="Pay with KHQR - Scan to pay">
                                                         <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                                         </svg>
                                                         Confirm Order
                                                     </a>
                                                 @endif

                                                 @if ($order->status === 'pending')
                                                    <button
                                                        type="button"
                                                        x-data=""
                                                        x-on:click="$dispatch('open-modal', { name: 'cancel-order', url: '{{ route('orders.destroy', $order) }}' })"
                                                        class="inline-flex items-center px-3 py-2 text-xs font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition shadow-sm hover:shadow-md"
                                                        title="Cancel Order">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                @elseif ($order->status === 'completed' && !$order->review)
                                                    <a href="{{ route('orders.show', $order) }}#review-section"
                                                       class="inline-flex items-center px-3 py-2 text-xs font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition shadow-sm hover:shadow-md"
                                                       title="Confirm & Review">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Review
                                                    </a>
                                                @elseif ($order->status === 'completed' && $order->review)
                                                    <span class="inline-flex items-center px-3 py-2 text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-900/40 rounded-lg">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                        Reviewed
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($orders as $order)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">#{{ $order->id }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $order->freelancer->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $order->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                     <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold
                                         {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' :
                                            ($order->status === 'pending' ? 'bg-amber-100 text-amber-700' :
                                            'bg-blue-100 text-blue-700') }}">
                                         {{ $order->status }}
                                     </span>
                                     @if($order->payment_status === 'paid')
                                         <span class="ml-1 inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Paid</span>
                                     @else
                                         <span class="ml-1 inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Unpaid</span>
                                     @endif
                                 </div>
                                <div class="mb-3">
                                    <a href="{{ route('services.show', $order->service) }}" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-indigo-600">
                                        {{ $order->service->title }}
                                    </a>
                                    <div class="text-lg font-black text-emerald-600 dark:text-emerald-400 mt-1">
                                        ${{ number_format($order->amount, 2) }}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('chat.show', $order) }}" class="flex-1 text-center px-3 py-2 text-xs font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                        Chat
                                    </a>
                                     <a href="{{ route('orders.show', $order) }}" class="flex-1 text-center px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200">
                                         View
                                     </a>

                                     @if($order->payment_status !== 'paid' && !in_array($order->status, ['pending', 'completed', 'cancelled']))
                                         <a href="{{ route('orders.pay', $order) }}" 
                                            class="flex-1 text-center px-3 py-2 text-xs font-black text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 rounded-lg">
                                             Confirm Order
                                         </a>
                                     @endif

                                     @if ($order->status === 'pending')
                                        <button
                                            type="button"
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', { name: 'cancel-order', url: '{{ route('orders.destroy', $order) }}' })"
                                            class="flex-1 text-center px-3 py-2 text-xs font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                                            Cancel
                                        </button>
                                    @elseif ($order->status === 'completed' && !$order->review)
                                        <a href="{{ route('orders.show', $order) }}#review-section" class="flex-1 text-center px-3 py-2 text-xs font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">
                                            Review
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-900 mb-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Orders Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't placed any orders yet. Browse our services to get started!</p>
                        <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse Services
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirm-modal
        name="cancel-order"
        title="Cancel this order?"
        message="This action cannot be undone. The freelancer will be notified that the order has been cancelled."
        confirmText="Yes, Cancel Order"
        type="danger"
    />

</x-app-layout>

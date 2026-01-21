<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white border-b py-4 mb-8">
        <div class="max-w-5xl mx-auto px-4 flex items-center">
            <a href="{{ url('/client/browse') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Service
            </a>
            <span class="mx-auto text-xl font-bold text-gray-800">Complete Your Order</span>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 pb-12">
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b bg-gray-50">
                        <h2 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Project Requirements</h2>
                        <p class="text-sm text-gray-500">Provide the details the freelancer needs to get started.</p>
                    </div>

                    <form action="{{ url('/order/store') }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service_id }}">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Detailed Instructions</label>
                            <textarea name="requirements" rows="6" required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition"
                                placeholder="Describe exactly what you need. Attach links or references if available..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Delivery Preference</label>
                            <select name="delivery_format" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                                <option>Standard Delivery (3-5 Days)</option>
                                <option>Express Delivery (24 Hours) +$20</option>
                            </select>
                        </div>

                        <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                            <p class="text-xs text-blue-700">Your payment is held securely by FreelanceHub and only released to the freelancer after you approve the work.</p>
                        </div>

                        <form action="{{ url('/my-orders') }}" method="GET">
                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-lg hover:bg-indigo-700 transition shadow-lg text-lg">
                                Confirm and Pay Now
                            </button>
                        </form>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-8">
                    <div class="p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Order Summary</h3>

                        <div class="flex gap-4 mb-6">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=100" class="w-20 h-20 object-cover rounded-lg">
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 leading-tight">Responsive Web App with Laravel</h4>
                                <p class="text-xs text-gray-500 mt-1">by Sarah Chen</p>
                            </div>
                        </div>

                        <ul class="space-y-3 border-t pt-4 text-sm text-gray-600">
                            <li class="flex justify-between">
                                <span>Service Price</span>
                                <span class="font-semibold text-gray-900">$500.00</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Service Fee</span>
                                <span class="font-semibold text-gray-900">$15.00</span>
                            </li>
                            <li class="flex justify-between border-t pt-3 text-base text-gray-900 font-bold">
                                <span>Total</span>
                                <span class="text-indigo-600">$515.00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>

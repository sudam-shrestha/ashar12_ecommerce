<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-3xl mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Order Voucher</h1>
            <p class="text-gray-600">Order ID: #{{ $order->id }}</p>
            <p class="text-gray-600">Date: {{ $order->created_at->format('d M Y') }}</p>
        </div>

        <!-- Order Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Customer Details</h2>
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Contact:</strong> {{ $order->contact }}</p>
                <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Shop Details</h2>
                <p><strong>Shop:</strong> {{ $order->shop->name }}</p> <!-- Assuming shop has a name column -->
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Ordered Products</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3 text-left">Product</th>
                            <th class="border p-3 text-left">Image</th>
                            <th class="border p-3 text-right">Price</th>
                            <th class="border p-3 text-right">Discount</th>
                            <th class="border p-3 text-right">Quantity</th>
                            <th class="border p-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_descriptions as $description)
                            <tr>
                                <td class="border p-3">{{ $description->product->name }}</td>
                                <td class="border p-3">
                                    <img src="{{ asset(Storage::url($description->product->images[0])) }}"
                                        alt="{{ $description->product->name }}" class="w-16 h-16 object-cover rounded">
                                </td>
                                <td class="border p-3 text-right">${{ number_format($description->product->price, 2) }}
                                </td>
                                <td class="border p-3 text-right">{{ $description->product->discount_percentage }}%
                                </td>
                                <td class="border p-3 text-right">{{ $description->qty }}</td>
                                <td class="border p-3 text-right">${{ number_format($description->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="flex justify-end mb-6">
            <div class="text-right">
                <p class="text-lg font-semibold">Total Amount: <span
                        class="text-green-600">${{ number_format($order->total_amount, 2) }}</span></p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <!-- Print Button -->
        <div class="text-center">
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Print
                Voucher</button>
        </div>
    </div>
</body>

</html>

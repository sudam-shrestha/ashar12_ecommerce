<x-frontend-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>

        @if ($carts->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-medium text-gray-700 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Start shopping to add items to your cart</p>
                <a href="{{ route('home') }}"
                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Continue Shopping
                </a>
            </div>
        @else
            <!-- Group carts by shop -->
            @php
                $groupedCarts = $carts->groupBy(function ($cartItem) {
                    return $cartItem->product->shop_id;
                });
            @endphp

            @foreach ($groupedCarts as $shopId => $shopCarts)
                @php
                    $shop = $shopCarts->first()->product->shop;
                    $shopTotal = 0;
                @endphp

                <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                    <!-- Shop Header -->
                    <div class="border-b border-gray-200 p-4 bg-gray-50 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                                <img src="{{ $shop->profile_image ? asset('storage/' . $shop->profile_image) : 'https://via.placeholder.com/100' }}"
                                    alt="{{ $shop->shop_name }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h2 class="font-bold">{{ $shop->shop_name }}</h2>
                                <p class="text-sm text-gray-600">{{ $shop->shop_address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="divide-y divide-gray-200">
                        @foreach ($shopCarts as $cart)
                            @php
                                $product = $cart->product;
                                $price = $product->price * (1 - $product->discount_percentage / 100);
                                $itemTotal = $price * $cart->qty;
                                $shopTotal += $itemTotal;
                            @endphp

                            <div class="p-4 flex flex-col md:flex-row">
                                <!-- Product Image -->
                                <div class="w-full md:w-1/6 mb-4 md:mb-0">
                                    <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                                        class="w-full h-32 object-contain">
                                </div>

                                <!-- Product Info -->
                                <div class="w-full md:w-3/6 px-0 md:px-4">
                                    <h3 class="font-medium text-lg">{{ $product->name }}</h3>
                                    <div class="text-gray-600 text-sm line-clamp-2">{!! $product->description !!}</div>

                                    <div class="mt-2 flex items-center">
                                        @if ($product->discount_percentage > 0)
                                            <span
                                                class="text-red-500 font-medium">${{ number_format($price, 2) }}</span>
                                            <span
                                                class="ml-2 text-gray-500 line-through text-sm">${{ number_format($product->price, 2) }}</span>
                                            <span
                                                class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded">{{ $product->discount_percentage }}%
                                                OFF</span>
                                        @else
                                            <span class="font-medium">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quantity Controls -->
                                <div
                                    class="w-full md:w-2/6 mt-4 md:mt-0 flex flex-col md:flex-row md:items-center md:justify-end">
                                    <div class="flex items-center mb-4 md:mb-0 md:mr-6">
                                        <form action="{{ route('cart.update', $cart->id) }}" method="POST"
                                            class="flex items-center">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="decrease-qty w-8 h-8 border border-gray-300 rounded-l-md flex items-center justify-center hover:bg-gray-100">
                                                <i class="fas fa-minus text-gray-600"></i>
                                            </button>
                                            <input type="number" name="qty" value="{{ $cart->qty }}"
                                                min="1"
                                                class="w-12 h-8 border-t border-b border-gray-300 text-center quantity-input">
                                            <button type="button"
                                                class="increase-qty w-8 h-8 border border-gray-300 rounded-r-md flex items-center justify-center hover:bg-gray-100">
                                                <i class="fas fa-plus text-gray-600"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-bold">${{ number_format($itemTotal, 2) }}</p>
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm mt-1">
                                                <i class="fas fa-trash mr-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Shop Subtotal and Checkout -->
                    <div class="border-t border-gray-200 p-4 bg-gray-50 flex justify-between items-center">
                        <div class="text-right">
                            <p class="text-gray-600">Subtotal for {{ $shop->shop_name }}:</p>
                            <p class="text-xl font-bold">${{ number_format($shopTotal, 2) }}</p>
                        </div>
                        <form action="{{ route('checkout', $shop->id) }}" method="GET">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Checkout Now
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity controls
            document.querySelectorAll('.increase-qty').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.quantity-input');
                    input.value = parseInt(input.value) + 1;
                    input.closest('form').submit();
                });
            });

            document.querySelectorAll('.decrease-qty').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.quantity-input');
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        input.closest('form').submit();
                    }
                });
            });

            // Auto-submit when quantity changes
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value > 0) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
</x-frontend-layout>

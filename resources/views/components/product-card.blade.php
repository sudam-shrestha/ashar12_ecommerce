@props(['product'])
<a href="{{ route('product', $product->id) }}"
    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.02]">
    <!-- Product Images (using first image from JSON array) -->
    <div class="relative h-48 bg-gray-200">
        <img src="{{ asset(Storage::url($product->images[0])) }}" alt="Product Image" class="w-full h-full object-cover">
        <!-- Discount Badge -->
        <span
            class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $product->discount_percentage }}%
            OFF</span>
    </div>

    <div class="p-4">
        <div class="flex justify-between items-start mb-2">
            <h3 class="font-bold text-lg truncate">{{ $product->name }}</h3>
            <!-- Shop Info -->
            <div class="flex-shrink-0 ml-2">
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full overflow-hidden">
                        <img src="{{ asset(Storage::url($product->shop->profile_image)) }}"
                            alt="{{ $product->shop->name }}" class="w-full h-full object-cover">
                    </div>
                    <span class="ml-1 text-xs text-gray-600">{{ $product->shop->name }}</span>
                </div>
            </div>
        </div>

        <div class="text-gray-600 text-sm mb-3 line-clamp-2">
            {!! $product->description !!}
        </div>

        <div class="pb-6">
            <div>
                <span class="text-lg font-bold text-gray-900">
                    NRs. {{ $product->price - $product->price * ($product->discount_percentage / 100) }}
                </span>
                <span class="ml-2 text-sm text-gray-500 line-through">
                    NRs. {{ $product->price }}
                </span>
            </div>
            <button
                class="float-right bg-[var(--color-primary)] text-white px-3 py-1 rounded-full text-sm transition-colors duration-300">
                Add to Cart
            </button>
        </div>
    </div>
</a>

<x-frontend-layout>

    <!-- Shop Detail Section -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Shop Header -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="md:flex">
                    <!-- Shop Image -->
                    <div class="md:w-1/3">
                        <img class="h-full w-full object-cover" src="{{ asset(Storage::url($shop->profile_image)) }}"
                            alt="Shop image">
                    </div>

                    <!-- Shop Info -->
                    <div class="p-8 md:w-2/3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $shop->shop_name }}</h1>
                                <div class="flex items-center mt-2">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $shop->shop_type }}</span>
                                    <span
                                        class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i> Verified
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <button class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Rating and Info -->
                        <div class="mt-4 flex flex-wrap items-center gap-4">
                            <div class="flex items-center">
                                <div class="flex items-center text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-1 text-gray-600">4.5 (128 reviews)</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>123 Tech Street, Silicon Valley, CA</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone-alt mr-2"></i>
                                <span>+1 (555) 123-4567</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <p class="text-gray-700">
                                Tech Haven is your one-stop shop for all the latest gadgets and electronics.
                                We specialize in high-quality tech products with competitive prices and excellent
                                customer service.
                                Founded in 2015, we've served over 10,000 satisfied customers worldwide.
                            </p>
                        </div>

                        <!-- Stats -->
                        <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">5,000+</p>
                                <p class="text-gray-600">Products</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">98%</p>
                                <p class="text-gray-600">Positive Ratings</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">24h</p>
                                <p class="text-gray-600">Avg. Shipping</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Products Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">All Products ({{ $products->count() }})</h2>
                    <form action="{{ route('shop', $shop->id) }}" method="get">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <select name="sort"
                                    class="appearance-none bg-white border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm">
                                    <option {{ $sort == 'newest' ? 'selected' : '' }} value="newest">Sort by: Newest
                                    </option>
                                    <option {{ $sort == 'price_low_to_high' ? 'selected' : '' }}
                                        value="price_low_to_high">Sort by: Price Low to High</option>
                                    <option {{ $sort == 'price_high_to_low' ? 'selected' : '' }}
                                        value="price_high_to_low">Sort by: Price High to Low</option>
                                </select>
                                <i
                                    class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                            </div>
                            <button type="submit" class="p-2 rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">
                                <i class="fas fa-sliders-h"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>

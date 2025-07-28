<x-frontend-layout>


    <!-- Product Detail Section -->
    <section class="py-6">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <!-- Product Images Gallery -->
                    <div class="md:w-1/2 p-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- Thumbnail Navigation -->
                            <div class="flex md:flex-col order-1 gap-2 overflow-x-auto pb-2 md:pb-0">
                                @foreach ($product->images as $i => $img)
                                    <button
                                        class="thumbnail-btn flex-shrink-0 w-16 h-16  {{ $i == 0 ? 'border-2 border-[var(--color-primary)]' : '' }} rounded-md overflow-hidden">
                                        <img src="{{ asset(Storage::url($img)) }}" alt="Thumbnail {{ $i + 1 }}"
                                            class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>

                            <!-- Main Image -->
                            <div class="order-2 md:order-1 flex-1 relative">
                                <div class="main-image-container aspect-square bg-gray-100 rounded-lg overflow-hidden">
                                    <img id="main-image" src="{{ asset(Storage::url($product->images[0])) }}"
                                        alt="Main product image"
                                        class="w-full h-full object-contain transition-opacity duration-300">
                                </div>
                                <button
                                    class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-[var(--color-primary)] hover:text-white">
                                    <i class="far fa-heart"></i>
                                </button>
                                <span
                                    class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">15%
                                    OFF</span>
                                <button
                                    class="image-zoom absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hidden md:block">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="md:w-1/2 p-6">
                        <div class="mb-4">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <div class="flex items-center mt-2">
                                <div class="flex items-center text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-600">4.5 (128 reviews)</span>
                                <span class="mx-2 text-gray-300">|</span>
                                <span class="text-green-600 flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i> In Stock
                                </span>
                            </div>
                        </div>

                        <!-- Shop Info -->
                        <div class="flex items-center mb-4 p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                                <img src="{{ asset(Storage::url($product->shop->profile_image)) }}" alt="Shop logo"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-medium">{{ $product->shop->shop_name }}</h3>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <span>San Francisco, CA</span>
                                </div>
                            </div>
                            <a href="{{ route('shop', $product->shop->id) }}"
                                class="ml-auto text-[var(--color-primary)] text-sm font-medium hover:underline">Visit
                                Shop</a>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-gray-900">
                                    NRs. {{ $product->price - $product->price * ($product->discount_percentage / 100) }}
                                </span>
                                <span class="ml-2 text-lg text-gray-500 line-through">
                                    NRs. {{ $product->price }}
                                </span>
                                <span class="ml-2 bg-red-100 text-red-800 text-sm font-medium px-2 py-0.5 rounded">Save
                                    {{ $product->discount_percentage }}%</span>
                            </div>
                        </div>

                        <form action="{{ route('add_to_cart') }}" method="post">
                            @csrf
                            <!-- Quantity -->
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Quantity</h3>
                                <div class="flex items-center">
                                    <button type="button" onclick="decrementQty()"
                                        class="w-10 h-10 border border-gray-300 rounded-l-md flex items-center justify-center hover:bg-gray-100">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="hidden" name="amount"
                                        value="{{ $product->discount_percentage > 0 ? $product->price - $product->price * ($product->discount_percentage / 100) : $product->price }}">
                                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                    <input type="number" name="qty" id="qty" value="1" min="1"
                                        max="10" class="w-16 h-10 border-t border-b border-gray-300 text-center">
                                    <button type="button" onclick="incrementQty()"
                                        class="w-10 h-10 border border-gray-300 rounded-r-md flex items-center justify-center hover:bg-gray-100">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <span class="ml-4 text-sm text-gray-500">Only 12 left</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col space-y-3 mb-6">
                                <button type="submit"
                                    class="bg-[var(--color-primary)] text-white py-3 px-6 rounded-md font-medium flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                                <button
                                    class="border border-[var(--color-primary)] text-[var(--color-primary)] hover:bg-blue-50 py-3 px-6 rounded-md font-medium">
                                    Buy Now
                                </button>
                            </div>
                        </form>

                        <!-- Delivery Options -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-start mb-3">
                                <i class="fas fa-truck text-gray-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-gray-900">Delivery</h4>
                                    <p class="text-sm text-gray-600">Estimated delivery: <span class="font-medium">2-4
                                            business days</span></p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-undo-alt text-gray-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-gray-900">Returns</h4>
                                    <p class="text-sm text-gray-600">30-day easy return policy. <a href="#"
                                            class="text-[var(--color-primary)] hover:underline">Details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Tabs -->
                <div class="border-t border-gray-200">
                    <nav class="flex overflow-x-auto">
                        <button
                            class="tab-btn active px-6 py-4 font-medium text-[var(--color-primary)] border-b-2 border-[var(--color-primary)]">Description</button>
                        <button
                            class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-[var(--color-primary)] border-b-2 border-transparent">Specifications</button>
                        <button
                            class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-[var(--color-primary)] border-b-2 border-transparent">Reviews
                            (128)</button>
                        <button
                            class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-[var(--color-primary)] border-b-2 border-transparent">Shipping
                            & Returns</button>
                    </nav>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <div class="tab-content active">
                            <h3 class="text-lg font-bold mb-4">Product Description</h3>
                            <div class="prose max-w-none">
                                <p>Experience premium sound quality with our Wireless Bluetooth Headphones. Designed for
                                    audiophiles and casual listeners alike, these headphones deliver crystal-clear audio
                                    with deep bass and crisp highs.</p>

                                <h4 class="font-bold mt-4">Key Features:</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Active Noise Cancellation (ANC) technology</li>
                                    <li>40mm dynamic drivers for powerful sound</li>
                                    <li>30-hour battery life with quick charge (5 min charge = 2 hours playback)</li>
                                    <li>Bluetooth 5.0 with 30ft range</li>
                                    <li>Built-in microphone for hands-free calls</li>
                                    <li>Soft memory-protein ear cushions for all-day comfort</li>
                                    <li>Foldable design with carrying case included</li>
                                </ul>

                                <h4 class="font-bold mt-4">What's in the Box:</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Wireless Headphones</li>
                                    <li>Carrying Case</li>
                                    <li>USB-C Charging Cable</li>
                                    <li>3.5mm Audio Cable</li>
                                    <li>Quick Start Guide</li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content hidden">
                            <!-- Specifications content would go here -->
                        </div>

                        <div class="tab-content hidden">
                            <!-- Reviews content would go here -->
                        </div>

                        <div class="tab-content hidden">
                            <!-- Shipping & Returns content would go here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">You May Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Related Product 1 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="https://via.placeholder.com/300x300?text=Related+1" alt="Related product"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-[var(--color-primary)] hover:text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1 truncate">Wireless Earbuds Pro</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold">$59.99</span>
                                    <span class="text-sm text-gray-500 line-through ml-1">$79.99</span>
                                </div>
                                <button
                                    class="bg-[var(--color-primary)] text-white p-2 rounded-full hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Related Product 2 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="https://via.placeholder.com/300x300?text=Related+2" alt="Related product"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-[var(--color-primary)] hover:text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1 truncate">Bluetooth Speaker</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold">$39.99</span>
                                </div>
                                <button
                                    class="bg-[var(--color-primary)] text-white p-2 rounded-full hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Related Product 3 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="https://via.placeholder.com/300x300?text=Related+3" alt="Related product"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-[var(--color-primary)] hover:text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1 truncate">Noise Cancelling Headphones</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold">$129.99</span>
                                </div>
                                <button
                                    class="bg-[var(--color-primary)] text-white p-2 rounded-full hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Related Product 4 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="https://via.placeholder.com/300x300?text=Related+4" alt="Related product"
                                class="w-full h-48 object-cover">
                            <button
                                class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-[var(--color-primary)] hover:text-white">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1 truncate">Gaming Headset</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold">$89.99</span>
                                    <span class="text-sm text-gray-500 line-through ml-1">$109.99</span>
                                </div>
                                <button
                                    class="bg-[var(--color-primary)] text-white p-2 rounded-full hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function incrementQty() {
            let qty = parseInt(document.getElementById('qty').value);
            qty++;
            document.getElementById('qty').value = qty;
        }

        function decrementQty() {
            let qty = parseInt(document.getElementById('qty').value);
            if (qty > 1) {
                qty--;
                document.getElementById('qty').value = qty;
            }
        }

        // Image gallery functionality
        document.querySelectorAll('.thumbnail-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all thumbnails
                document.querySelectorAll('.thumbnail-btn').forEach(b => {
                    b.classList.remove('border-[var(--color-primary)]');
                    b.classList.add('border-gray-200');
                    b.classList.remove('border-2');
                });

                // Add active class to clicked thumbnail
                this.classList.add('border-[var(--color-primary)]');
                this.classList.add('border-2');
                this.classList.remove('border-gray-200');

                // Update main image
                const thumbnailImg = this.querySelector('img');
                const mainImage = document.getElementById('main-image');
                mainImage.src = thumbnailImg.src.replace('300x300', '600x600');
            });
        });

        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('active');
                    b.classList.remove('text-[var(--color-primary)]');
                    b.classList.remove('border-[var(--color-primary)]');
                    b.classList.add('text-gray-600');
                    b.classList.add('border-transparent');
                });

                // Add active class to clicked tab
                this.classList.add('active');
                this.classList.add('text-[var(--color-primary)]');
                this.classList.add('border-[var(--color-primary)]');
                this.classList.remove('text-gray-600');
                this.classList.remove('border-transparent');

                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });

                // Show corresponding tab content
                const tabIndex = Array.from(document.querySelectorAll('.tab-btn')).indexOf(this);
                document.querySelectorAll('.tab-content')[tabIndex].classList.remove('hidden');
                document.querySelectorAll('.tab-content')[tabIndex].classList.add('active');
            });
        });
    </script>

</x-frontend-layout>

<x-frontend-layout>

    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Featured Shops</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($shops as $shop)
                    <a href="{{ route('shop', $shop->id) }}"
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <div class="relative h-48 bg-gray-200">
                            <!-- Shop Image -->
                            <img src="{{ asset(Storage::url($shop->profile_image)) }}" alt="{{ $shop->shop_name }}"
                                class="w-full h-full object-cover">
                            <!-- Shop Type Badge -->
                            <span
                                class="absolute top-2 right-2 bg-[var(--color-primary)] text-white text-xs px-2 py-1 rounded-full">{{ $shop->shop_type }}</span>
                        </div>

                        <div class="p-6">

                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $shop->shop_address }}</span>
                                </div>

                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <span>{{ $shop->contact_number }}</span>
                                </div>

                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $shop->email }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
    </section>

    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Special Deals</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container py-14">
            <div>
                <h2 class="text-center text-3xl mb-2">
                    List your Restaurant or Store at Floor Digital Pvt. Ltd.! <br>
                    Reach 1,00,000 + new customers.
                </h2>
            </div>
            <div class="grid grid-cols-2 items-center gap-5">
                <div>
                    <img class="w-full" src="{{ asset('frontend/images/request.jpg') }}" alt="">
                </div>

                <div>
                    <form id="form" action="{{ route('shop_request') }}" method="post">
                        @csrf

                        <div class="space-y-3">
                            <div>
                                <label for="name" class="mb-1">Enter your name <span
                                        class="text-[red]">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                            </div>

                            <div>
                                <label for="email" class="mb-1">Enter your email <span
                                        class="text-[red]">*</span></label>
                                <input type="email" name="email" id="email"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                            </div>

                            <div>
                                <label for="shop_type" class="mb-1">Select Shop Type <span
                                        class="text-[red]">*</span></label>

                                <select name="shop_type" id="shop_type"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                                    <option value="meat_shop">Meat Shop</option>
                                    <option value="kirana_pasal">Kirana Pasal</option>
                                    <option value="khaja_dokan">Khaja Dokan</option>
                                </select>
                            </div>

                            <div>
                                <label for="shop_name" class="mb-1">Enter your shop name <span
                                        class="text-[red]">*</span></label>
                                <input type="text" name="shop_name" id="shop_name"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                            </div>

                            <div>
                                <label for="shop_address" class="mb-1">Enter your shop address <span
                                        class="text-[red]">*</span></label>
                                <input type="text" name="shop_address" id="shop_address"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                            </div>

                            <div>
                                <label for="contact_number" class="mb-1">Enter your Contact Number <span
                                        class="text-[red]">*</span></label>
                                <input type="text" name="contact_number" id="contact_number"
                                    class="w-full px-2 py-1 border rounded bg-[var(--color-light-grey)]">
                            </div>

                            <div>
                                <button id="submit-btn" type="submit"
                                    class="rounded w-full py-2 text-white bg-[var(--color-primary)]">Send
                                    Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        let btn = document.getElementById('submit-btn');
        let form = document.getElementById('form');
        btn.addEventListener('click', function(e) {
            form.submit();
            btn.innerHTML = "Please wait...";
            btn.disabled = true;
        })
    </script>

</x-frontend-layout>

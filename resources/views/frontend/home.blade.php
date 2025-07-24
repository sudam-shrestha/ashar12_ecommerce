<x-frontend-layout>

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
                    <form action="{{route('shop_request')}}" method="post">
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
                                <button type="submit" class="rounded w-full py-2 text-white bg-[var(--color-primary)]">Send
                                    Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-frontend-layout>

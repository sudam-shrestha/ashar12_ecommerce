<x-frontend-layout>

    <section>
        <div class="container">
            <h1 class="text-3xl font-bold mb-6">Checkout</h1>

            <form action="{{ route('checkout.store', $id) }}" method="post">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="mb-4">
                        <label for="shipping_address" class="block text-gray-700 font-bold mb-2">Shipping Address</label>
                        <input type="text" id="shipping_address" name="shipping_address"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="block text-gray-700 font-bold mb-2">Contact Number</label>
                        <input type="text" id="contact" name="contact"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-gray-700 font-bold mb-2">Payment Method</label>
                        <select id="payment_method" name="payment_method"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="khalti">Pay With Khalti</option>
                            <option value="cash_on_delivery">Cash on Delivery</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">Order</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-frontend-layout>

<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="flex items-center font-poppins">
        <div class="justify-center flex-1 max-w-6xl px-4 py-6 mx-auto bg-white border rounded-xl shadow-sm md:py-10 md:px-10">

            <h1 class="mb-8 text-2xl font-semibold text-gray-700">
                Thank you. Your order has been received.
            </h1>

            <!-- CUSTOMER INFO -->
            <div class="flex border-b pb-6 mb-8">
                <div class="flex flex-col space-y-1">
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $order->address->full_name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $order->address->street_address }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $order->address->city }},
                        {{ $order->address->state }},
                        {{ $order->address->zip_code }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $order->address->phone }}
                    </p>
                </div>
            </div>

            <!-- ORDER META -->
            <div class="flex flex-wrap border-b pb-4 mb-10">
                <div class="w-full md:w-1/4 mb-4">
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-semibold">{{ $order->id }}</p>
                </div>

                <div class="w-full md:w-1/4 mb-4">
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-semibold">{{ $order->created_at->format('d-m-Y') }}</p>
                </div>

                <div class="w-full md:w-1/4 mb-4">
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="font-semibold text-green-600">
                        {{ Number::currency($order->grand_total, 'PHP') }}
                    </p>
                </div>

                <div class="w-full md:w-1/4 mb-4">
                    <p class="text-sm text-gray-500">Payment Method</p>
                    <p class="font-semibold">
                        {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Card' }}
                    </p>
                </div>
            </div>

            <!-- DETAILS + SHIPPING -->
            @php
                $shipping = $order->shipping_amount ?? 0;
                $subtotal = $order->grand_total - $shipping;
            @endphp

            <div class="flex flex-col md:flex-row gap-8 mb-10">

                <!-- ORDER DETAILS -->
                <div class="w-full md:w-1/2">
                    <h2 class="mb-4 text-xl font-semibold text-gray-700">
                        Order Details
                    </h2>

                    <div class="space-y-3 border-b pb-4 mb-4">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>{{ Number::currency($subtotal, 'PHP') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Discount</span>
                            <span>{{ Number::currency(0, 'PHP') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>{{ Number::currency($shipping, 'PHP') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>{{ Number::currency($order->grand_total, 'PHP') }}</span>
                    </div>
                </div>

                <!-- SHIPPING -->
                <div class="w-full md:w-1/2">
                    <h2 class="mb-4 text-xl font-semibold text-gray-700">
                        Shipping
                    </h2>

                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.48 1.85a1.5 1.5 0 0 1 .33.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-4 0V3.5z"/>
                            </svg>

                            <div>
                                <p class="font-semibold">
                                    {{ $order->shipping_method }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Delivery within 24 hours
                                </p>
                            </div>
                        </div>

                        <p class="font-semibold">
                            {{ Number::currency($shipping, 'PHP') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="flex flex-col md:flex-row gap-4">
                <a href="/products"
                   class="w-full md:w-auto px-4 py-2 text-center border border-blue-500 text-blue-500 rounded-md hover:bg-blue-600 hover:text-white">
                    Go back shopping
                </a>

                <a href="{{ route('myorders.index') }}"
                   class="w-full md:w-auto px-4 py-2 text-center bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    View My Orders
                </a>
            </div>

        </div>
    </section>
</div>

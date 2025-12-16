<div class="min-h-screen bg-slate-100 dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
            Order Details
        </h1>

        @php
            $shipping = $order->shipping_amount ?? 0;
            $subtotal = max(($order->grand_total ?? 0) - $shipping, 0);
        @endphp

        <!-- INFO CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-5">
                <p class="text-xs text-gray-500 uppercase mb-1">Customer</p>
                <p class="font-semibold">
                    {{ $address->first_name }} {{ $address->last_name }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-5">
                <p class="text-xs text-gray-500 uppercase mb-1">Order Date</p>
                <p class="font-semibold">
                    {{ $order->created_at->format('d M Y') }}
                </p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-5">
                <p class="text-xs text-gray-500 uppercase mb-2">Order Status</p>
                <span class="px-3 py-1 rounded-full text-white text-sm bg-blue-500">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-5">
                <p class="text-xs text-gray-500 uppercase mb-2">Payment Status</p>
                <span class="px-3 py-1 rounded-full text-white text-sm bg-green-600">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <!-- ITEMS + SUMMARY -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- ITEMS -->
            <div class="lg:col-span-3 bg-white dark:bg-slate-900 rounded-xl shadow p-6 overflow-x-auto">
                <h2 class="text-lg font-semibold mb-4">Ordered Items</h2>

                <table class="w-full text-left">
                    <thead class="border-b">
                        <tr class="text-sm text-gray-500">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order_items as $item)
                            @php
                                $image = asset('images/no-image.png');

                                if (!empty($item->product?->image)) {
                                    $image = asset(
                                        'storage/products/' .
                                        str_replace('products/', '', $item->product->image)
                                    );
                                }

                                $price = $item->price ?? 0;
                                $qty   = $item->quantity ?? 0;
                                $lineTotal = $price * $qty;
                            @endphp

                            <tr class="border-b last:border-none">
                                <td class="py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $image }}"
                                             class="w-14 h-14 rounded object-cover"
                                             onerror="this.src='{{ asset('images/no-image.png') }}'">
                                        <span class="font-medium">
                                            {{ $item->product->name ?? 'Product unavailable' }}
                                        </span>
                                    </div>
                                </td>

                                <td>{{ Number::currency($price, 'PHP') }}</td>
                                <td>{{ $qty }}</td>
                                <td>{{ Number::currency($lineTotal, 'PHP') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- SUMMARY -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Summary</h2>

                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ Number::currency($subtotal, 'PHP') }}</span>
                </div>

                <div class="flex justify-between mb-2">
                    <span>Shipping ({{ $order->shipping_method }})</span>
                    <span>{{ Number::currency($shipping, 'PHP') }}</span>
                </div>

                <hr class="my-4">

                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span>{{ Number::currency($order->grand_total ?? 0, 'PHP') }}</span>
                </div>

                <div class="mt-6 text-sm">
                    <p class="font-semibold mb-1">Shipping Address</p>
                    <p>
                        {{ $address->street_address }},
                        {{ $address->city }},
                        {{ $address->state }},
                        {{ $address->zip_code }}
                    </p>
                    <p class="mt-1">Phone: {{ $address->phone }}</p>
                </div>

                <!-- INVOICE BUTTON -->
                <a href="{{ route('myorders.invoice', $order->id) }}"
                   class="block mt-6 text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                    Download Invoice (PDF)
                </a>
            </div>
        </div>
    </div>
</div>

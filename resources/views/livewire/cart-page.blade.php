<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-200">
            Shopping Cart
        </h1>

        <div class="flex flex-col md:flex-row gap-6">

            {{-- LEFT SIDE - CART ITEMS --}}
            <div class="md:w-3/4">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-md p-6 overflow-x-auto">

                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="py-3 text-left font-semibold">Product</th>
                                <th class="py-3 text-left font-semibold">Price</th>
                                <th class="py-3 text-left font-semibold">Qty</th>
                                <th class="py-3 text-left font-semibold">Total</th>
                                <th class="py-3 text-left font-semibold">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($cart_items as $item)
                            <tr wire:key="{{ $item['product_id'] }}" class="border-b dark:border-gray-700">

                                {{-- PRODUCT --}}
                                <td class="py-4">
                                    <div class="flex items-center gap-4">
                                        <img
                                            class="h-16 w-16 rounded-md object-cover shadow"
                                            src="{{ asset('storage/' . ($item['image'] ?? 'noimage.png')) }}"
                                            alt="{{ $item['name'] ?? 'Product' }}"
                                            onerror="this.src='/noimage.png'">

                                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $item['name'] ?? 'Unknown Product' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- PRICE --}}
                                <td class="py-4 text-gray-700 dark:text-gray-300">
                                    {{ Number::currency((float) ($item['unit_amount'] ?? 0), 'PHP') }}
                                </td>

                                {{-- QTY --}}
                                <td class="py-4">
                                    <div class="flex items-center">

                                        <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                            class="border rounded-md px-3 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                            -
                                        </button>

                                        <span class="mx-3 text-gray-800 dark:text-gray-100">
                                            {{ $item['quantity'] ?? 0 }}
                                        </span>

                                        <button wire:click="increaseQty({{ $item['product_id'] }})"
                                            class="border rounded-md px-3 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                            +
                                        </button>

                                    </div>
                                </td>

                                {{-- TOTAL --}}
                                <td class="py-4 text-gray-700 dark:text-gray-300">
                                    {{ Number::currency((float) ($item['total_amount'] ?? 0), 'PHP') }}
                                </td>

                                {{-- REMOVE --}}
                                <td class="py-4">
                                    <button wire:click="removeItem({{ $item['product_id'] }})"
                                        class="px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition">

                                        <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">
                                            Remove
                                        </span>

                                        <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">
                                            Removing...
                                        </span>

                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="py-6 text-center text-gray-500 dark:text-gray-400 font-semibold">
                                    Your cart is empty.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- RIGHT SIDE - SUMMARY --}}
            <div class="md:w-1/4">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-md p-6">

                    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">
                        Summary
                    </h2>

                    <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-3">
                        <span>Subtotal</span>
                        <span>{{ Number::currency((float) $grand_total, 'PHP') }}</span>
                    </div>

                    <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-3">
                        <span>Taxes</span>
                        <span>{{ Number::currency(0, 'PHP') }}</span>
                    </div>

                    <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-3">
                        <span>Shipping</span>
                        <span>{{ Number::currency(0, 'PHP') }}</span>
                    </div>

                    <hr class="my-4 border-gray-300 dark:border-gray-700">

                    <div class="flex justify-between mb-3">
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Total</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                            {{ Number::currency((float) $grand_total, 'PHP') }}
                        </span>
                    </div>

                    @if (!empty($cart_items))
                        <a href="/checkout"
                           class="block text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition mt-4">
                           Proceed to Checkout
                        </a>
                    @endif

                </div>
            </div>

        </div>

    </div>
</div>

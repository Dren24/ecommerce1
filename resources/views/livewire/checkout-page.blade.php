<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            Checkout
        </h1>

        <form wire:submit.prevent="placeOrder">
            <div class="grid grid-cols-12 gap-4">
                <!-- Left Column: Shipping Address -->
                <div class="md:col-span-12 lg:col-span-8 col-span-12">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                                Shipping Address
                            </h2>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="first_name">First Name</label>
                                    <input wire:model="first_name" id="first_name" type="text"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror">
                                    @error('first_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="last_name">Last Name</label>
                                    <input wire:model="last_name" id="last_name" type="text"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror">
                                    @error('last_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="phone">Phone</label>
                                <input wire:model="phone" id="phone" type="text"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror">
                                @error('phone')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="street_address">Address</label>
                                <input wire:model="street_address" id="street_address" type="text"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror">
                                @error('street_address')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="city">City</label>
                                <input wire:model="city" id="city" type="text"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror">
                                @error('city')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="state">State</label>
                                    <input wire:model="state" id="state" type="text"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('state') border-red-500 @enderror">
                                    @error('state')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="zip_code">ZIP Code</label>
                                    <input wire:model="zip_code" id="zip_code" type="text"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror">
                                    @error('zip_code')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="text-lg font-semibold mb-4">Select Payment Method</div>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="cod" required type="radio" value="cod" />
                                <label for="cod" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Cash on Delivery</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="stripe" type="radio" value="stripe" />
                                <label for="stripe" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Stripe</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        @error('payment_method')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="md:col-span-12 lg:col-span-4 col-span-12">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            ORDER SUMMARY
                        </div>

                        <div class="flex justify-between mb-2 font-bold">
                            <span>Subtotal</span>
                            <span>{{ Number::currency($grand_total, 'IDR') }}</span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>Taxes</span>
                            <span>{{ Number::currency(0, 'IDR') }}</span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>Shipping Cost</span>
                            <span>{{ Number::currency(0, 'IDR') }}</span>
                        </div>
                        <hr class="bg-slate-400 my-4 h-1 rounded">
                        <div class="flex justify-between mb-2 font-bold">
                            <span>Grand Total</span>
                            <span>{{ Number::currency($grand_total, 'IDR') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                        <span wire:loading.remove>Place Order</span>
                        <span wire:loading>Processing...</span>
                    </button>

                    <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            BASKET SUMMARY
                        </div>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                            @foreach ($cart_items as $item)
                                <li class="py-3 sm:py-4" wire:key="{{ $item['product_id'] }}">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="w-12 h-12 rounded-full" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ $item['name'] }}</p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">Quantity: {{ $item['quantity'] }}</p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{ Number::currency($item['total_amount'], 'IDR') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

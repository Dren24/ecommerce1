<div class="min-h-screen bg-slate-100 dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
            Checkout
        </h1>

        <form wire:submit.prevent="placeOrder" class="grid grid-cols-12 gap-6">

            <!-- LEFT -->
            <div class="col-span-12 lg:col-span-8 space-y-6">

                <!-- SHIPPING -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow p-6">
                    <h2 class="text-xl font-semibold mb-6">Shipping Address</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input wire:model.live="first_name" placeholder="First name"
                               class="input @error('first_name') border-red-500 @enderror">
                        <input wire:model.live="last_name" placeholder="Last name"
                               class="input @error('last_name') border-red-500 @enderror">
                    </div>

                    <input wire:model.live="phone" placeholder="Phone"
                           class="input mt-4 @error('phone') border-red-500 @enderror">

                    <input wire:model.live="street_address" placeholder="Street address"
                           class="input mt-4 @error('street_address') border-red-500 @enderror">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <input wire:model.live="city" placeholder="City" class="input">
                        <input wire:model.live="state" placeholder="State" class="input">
                        <input wire:model.live="zip_code" placeholder="ZIP Code" class="input">
                    </div>

                    <!-- REGION -->
                    <div class="mt-4">
                        <select wire:model.live="region"
                                class="input @error('region') border-red-500 @enderror">
                            <option value="">Select Shipping Region</option>
                            <option value="luzon">Luzon (₱100)</option>
                            <option value="visayas">Visayas (₱200)</option>
                            <option value="mindanao">Mindanao (₱300)</option>
                        </select>

                        @error('region')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Payment Method</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="payment-box {{ $payment_method === 'cod' ? 'selected-cod' : '' }}">
                            <input wire:model.live="payment_method" type="radio" value="cod" hidden>
                            <strong>Cash on Delivery</strong>
                            <p>Pay when item arrives</p>
                        </label>

                        <label class="payment-box {{ $payment_method === 'stripe' ? 'selected-stripe' : '' }}">
                            <input wire:model.live="payment_method" type="radio" value="stripe" hidden>
                            <strong>Stripe</strong>
                            <p>Credit / Debit card</p>
                        </label>
                    </div>
                </div>

                <!-- MOBILE BUTTON -->
                <button type="submit"
                        class="lg:hidden w-full bg-green-600 text-white py-3 rounded-xl text-lg
                               disabled:opacity-50"
                        @disabled(!$this->canSubmit)>
                    Place Order
                </button>
            </div>

            <!-- RIGHT -->
            <div class="col-span-12 lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                <!-- SUMMARY -->
<div class="bg-white rounded-2xl shadow p-6">
    <div class="flex justify-between mb-2">
        <span>Subtotal</span>
        <span>{{ Number::currency($subtotal, 'PHP') }}</span>
    </div>

    <div class="flex justify-between mb-2">
        <span>Shipping</span>
        <span>{{ Number::currency($shipping_fee, 'PHP') }}</span>
    </div>

    <hr class="my-4">

    <div class="flex justify-between font-bold text-lg">
        <span>Total</span>
        <span>{{ Number::currency($total, 'PHP') }}</span>
    </div>

    <button type="submit"
        class="w-full mt-6 bg-green-600 text-white py-3 rounded-xl text-lg disabled:opacity-50"
        @disabled(!$this->canSubmit)>
        Place Order
    </button>
</div>


                <!-- ITEMS -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow p-6">
                    <h2 class="font-semibold mb-4">Basket Summary</h2>

                    @foreach($cart_items as $item)
                        <div class="flex items-center gap-4 mb-4">
                            <img class="w-12 h-12 rounded"
                                 src="{{ asset('storage/products/'.str_replace('products/','',$item['image'])) }}">
                            <div class="flex-1">
                                <p class="font-medium">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">Qty {{ $item['quantity'] }}</p>
                            </div>
                            <span>{{ Number::currency($item['total_amount'], 'PHP') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    <!-- LOADING OVERLAY -->
    <div wire:loading.flex wire:target="placeOrder"
         class="fixed inset-0 bg-black/50 z-50 items-center justify-center">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-xl text-center">
            <div class="animate-spin h-8 w-8 border-b-2 border-green-600 mx-auto mb-3"></div>
            Processing your order...
        </div>
    </div>

    <style>
        .input {
            width: 100%;
            padding: .6rem;
            border-radius: .5rem;
            border: 1px solid #d1d5db;
        }
        .payment-box {
            border: 1px solid #d1d5db;
            padding: 1rem;
            border-radius: .75rem;
            cursor: pointer;
        }
        .selected-cod {
            border-color: #16a34a;
            background: #dcfce7;
        }
        .selected-stripe {
            border-color: #4f46e5;
            background: #eef2ff;
        }
    </style>
</div>

<div class="w-full max-w-[85rem] mx-auto py-10 px-4">

    @php
        // IMAGE
        $image = asset('images/no-image.png');
        if (!empty($product->image)) {
            $image = asset('storage/products/' . str_replace('products/', '', $product->image));
        }

        // PRICE (DB COLUMN = selling_price)
        $price = (float) ($product->selling_price ?? 0);
    @endphp

    <section class="bg-white dark:bg-gray-800 rounded-lg p-6">
        <div class="flex flex-wrap -mx-4">

            {{-- IMAGE --}}
            <div class="w-full md:w-1/2 px-4 mb-8">
                <img
                    src="{{ $image }}"
                    class="w-full rounded-lg object-cover"
                    onerror="this.src='{{ asset('images/no-image.png') }}'">
            </div>

            {{-- INFO --}}
            <div class="w-full md:w-1/2 px-4">
                <div class="lg:pl-12">

                    {{-- NAME --}}
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">
                        {{ $product->name }}
                    </h1>

                    {{-- PRICE --}}
                    <p class="text-4xl font-bold mb-4 text-gray-800 dark:text-gray-300">
                        {{ Number::currency($price, 'PHP') }}
                    </p>

                    @if($price <= 0)
                        <p class="text-red-500 mb-4">
                            Price not available for this product
                        </p>
                    @endif

                    {{-- DESCRIPTION --}}
                    <div class="text-gray-700 dark:text-gray-400 mb-6 leading-relaxed">
                        {!! Str::markdown($product->description ?? 'No description available.') !!}
                    </div>

                    {{-- QUANTITY --}}
                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">
                        Quantity
                    </label>

                    <div class="flex items-center w-48 h-14 bg-gray-200 dark:bg-gray-900 rounded-xl overflow-hidden mb-6">
                        <button
                            wire:click="decrementQty"
                            class="w-16 h-full text-2xl font-bold hover:bg-gray-300 dark:hover:bg-gray-700">
                            −
                        </button>

                        <input
                            type="number"
                            readonly
                            wire:model="quantity"
                            class="w-16 h-full text-center bg-transparent text-lg font-semibold">

                        <button
                            wire:click="incrementQty"
                            class="w-16 h-full text-2xl font-bold hover:bg-gray-300 dark:hover:bg-gray-700">
                            +
                        </button>
                    </div>

                    {{-- ADD TO CART --}}
                    <button
                        wire:click="addToCart"
                        @disabled($price <= 0)
                        class="w-full lg:w-2/5 py-4 text-lg rounded-lg text-white
                               bg-blue-600 hover:bg-blue-700
                               disabled:bg-gray-400 disabled:cursor-not-allowed">
                        Add to Cart
                    </button>

                </div>
            </div>

        </div>
    </section>
</div>

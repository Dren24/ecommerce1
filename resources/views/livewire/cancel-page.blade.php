<div class="min-h-screen bg-slate-100 dark:bg-slate-950 flex items-center">
    <div class="max-w-xl mx-auto px-4">

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow p-8 text-center">

            <!-- ICON -->
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9z"/>
                </svg>
            </div>

            <!-- TITLE -->
            <h1 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-3">
                Payment Failed
            </h1>

            <!-- MESSAGE -->
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Your payment was not completed and the order has been cancelled.
                If this was a mistake, you may try again or choose a different payment method.
            </p>

            <!-- ACTIONS -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('checkout') }}"
                   class="inline-flex justify-center items-center rounded-xl bg-indigo-600 px-6 py-3 text-white hover:bg-indigo-700">
                    Try Again
                </a>

                <a href="{{ route('products') }}"
                   class="inline-flex justify-center items-center rounded-xl border px-6 py-3 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-800">
                    Continue Shopping
                </a>
            </div>

        </div>

    </div>
</div>

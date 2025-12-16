<footer class="bg-gray-900 text-gray-300 mt-10 w-full">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">

            <!-- BRAND -->
            <div class="col-span-full lg:col-span-1">
                <a href="/" class="text-2xl font-semibold text-white">
                    RevnoParts
                </a>
                <p class="mt-2 text-gray-400 text-sm">
                    Premium Motorcycle Parts & Accessories
                </p>
            </div>

            <!-- PRODUCTS -->
            <div>
                <h4 class="font-semibold text-white">Products</h4>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="/categories" class="hover:text-white">Categories</a></li>
                    <li><a href="/products" class="hover:text-white">All Products</a></li>
                    <li><a href="/products" class="hover:text-white">Featured Products</a></li>
                </ul>
            </div>

            <!-- COMPANY -->
            <div>
                <h4 class="font-semibold text-white">Company</h4>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="#" class="hover:text-white">About Us</a></li>
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">Customers</a></li>
                </ul>
            </div>

            <!-- SUBSCRIBE -->
            <div class="col-span-2">
                <h4 class="font-semibold text-white">Stay Updated</h4>
                <p class="mt-2 text-gray-400 text-sm">
                    Get updates on new parts & promotions
                </p>

                <form class="mt-4">
                    <div class="flex flex-col sm:flex-row bg-gray-800 rounded-lg p-2 gap-2">
                        <input
                            type="email"
                            class="w-full px-4 py-3 rounded-lg bg-gray-900 text-sm border border-gray-700
                                   focus:border-blue-500 focus:ring-blue-500 text-gray-200"
                            placeholder="Enter your email"
                        >
                        <button
                            type="button"
                            class="px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700"
                        >
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Bottom -->
        <div class="mt-10 border-t border-gray-700 pt-6 flex flex-col sm:flex-row items-center justify-between">

            <p class="text-sm text-gray-400">
                © {{ date('Y') }} RevnoParts. All rights reserved.
            </p>

            <!-- Social Icons -->
            <div class="flex gap-3 mt-4 sm:mt-0">

                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0022 12z"/>
                    </svg>
                </a>

                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <span class="sr-only">GitHub</span>
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .5A12 12 0 000 12.6c0 5.4 3.4 10 8.2 11.6.6.1.8-.3.8-.6v-2.1c-3.3.7-4-1.6-4-1.6-.6-1.5-1.4-1.9-1.4-1.9-1.1-.8.1-.8.1-.8 1.2.1 1.8 1.3 1.8 1.3 1.1 1.9 2.9 1.3 3.6 1 .1-.8.4-1.3.7-1.6-2.6-.3-5.3-1.3-5.3-5.8 0-1.3.5-2.3 1.2-3.1-.1-.3-.5-1.5.1-3.1 0 0 1-.3 3.2 1.2a11 11 0 015.8 0c2.2-1.5 3.2-1.2 3.2-1.2.6 1.6.2 2.8.1 3.1.8.8 1.2 1.8 1.2 3.1 0 4.5-2.7 5.5-5.3 5.8.4.3.8 1 .8 2.1v3.1c0 .3.2.7.8.6A12 12 0 0024 12.6 12 12 0 0012 .5z"/>
                    </svg>
                </a>

            </div>

        </div>
    </div>
</footer>

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

            <!-- PRODUCT LINKS -->
            <div>
                <h4 class="font-semibold text-white">Products</h4>
                <ul class="mt-4 space-y-3 text-sm">
                    <li>
                        <a href="/categories" class="hover:text-white">Categories</a>
                    </li>
                    <li>
                        <a href="/products" class="hover:text-white">All Products</a>
                    </li>
                    <li>
                        <a href="/products" class="hover:text-white">Featured Products</a>
                    </li>
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
                <p class="mt-2 text-gray-400 text-sm">Get updates on new parts & promotions</p>

                <form class="mt-4">
                    <div class="flex flex-col sm:flex-row bg-gray-800 rounded-lg p-2 gap-2">
                        <input
                            type="email"
                            class="w-full px-4 py-3 rounded-lg bg-gray-900 text-sm border border-gray-700 focus:border-blue-500 focus:ring-blue-500"
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
        <!-- End Grid -->

        <!-- Bottom Section -->
        <div class="mt-10 border-t border-gray-700 pt-6 flex flex-col sm:flex-row items-center justify-between">

            <p class="text-sm text-gray-400">
                © {{ date('Y') }} RevnoParts. All rights reserved.
            </p>

            <!-- Social Icons -->
            <div class="flex gap-3 mt-4 sm:mt-0">

                <!-- Facebook -->
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05..."/>
                    </svg>
                </a>

                <!-- Google -->
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.42 9.42 0 01.139 1.626c0 2.434..."/>
                    </svg>
                </a>

                <!-- Twitter/X -->
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334..."/>
                    </svg>
                </a>

                <!-- GitHub -->
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29..."/>
                    </svg>
                </a>

            </div>

        </div>
    </div>
</footer>

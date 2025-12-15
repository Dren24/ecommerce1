<header class="flex z-50 sticky top-0 bg-white shadow-md dark:bg-gray-800">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8 py-3" aria-label="Global">
    <div class="flex items-center justify-between">

      <!-- BRAND -->
      <a class="text-xl font-semibold dark:text-white" href="/">
        RevnoParts
      </a>

      <!-- MOBILE MENU BUTTON -->
      <button 
        class="md:hidden hs-collapse-toggle flex items-center justify-center w-9 h-9 rounded-lg border border-gray-300 dark:border-gray-700"
        data-hs-collapse="#navbar-menu"
        aria-controls="navbar-menu"
      >
        <svg class="hs-collapse-open:hidden w-5 h-5" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
        <svg class="hs-collapse-open:block hidden w-5 h-5" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/>
        </svg>
      </button>

      <!-- NAV LINKS -->
      <div id="navbar-menu" class="hs-collapse hidden md:block basis-full md:basis-auto">
        <div class="flex flex-col md:flex-row md:items-center md:gap-x-7 mt-4 md:mt-0">


          <!-- 🔍 SEARCH BAR (BEFORE HOME) -->
          <form action="/products" method="GET" class="relative hidden lg:block mr-4">
            <input 
              type="text" 
              name="search"
              placeholder="Search parts..."
              class="w-56 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                     bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 
                     focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button class="absolute right-2 top-2 text-gray-500">
              <svg class="w-5 h-5" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
              </svg>
            </button>
          </form>


          <!-- HOME -->
          <a href="/" wire:navigate
            class="font-medium py-2 md:py-6
              {{ request()->is('/') ? 'text-blue-600' : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white' }}">
            Home
          </a>

          <!-- CATEGORIES -->
          <a href="/categories" wire:navigate
            class="font-medium py-2 md:py-6
              {{ request()->is('categories') ? 'text-blue-600' : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white' }}">
            Categories
          </a>

          <!-- PRODUCTS -->
          <a href="/products" wire:navigate
            class="font-medium py-2 md:py-6
              {{ request()->is('products') ? 'text-blue-600' : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white' }}">
            Products
          </a>

          <!-- CART -->
          <a href="/cart" wire:navigate
            class="font-medium flex items-center py-2 md:py-6
              {{ request()->is('cart') ? 'text-blue-600' : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white' }}">
            
            <svg class="w-5 h-5 mr-1" fill="none" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5M18 8.507l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25A1.125 1.125 0 013.13 20.507l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
            </svg>

            Cart
            <span class="ml-2 rounded-full bg-blue-100 text-blue-600 text-xs px-1.5 py-0.5">
              {{ $total_count }}
            </span>
          </a>


          <!-- LOGIN / USER ACCOUNT -->
          @guest
            <a href="/login" wire:navigate
              class="mt-3 md:mt-0 py-2.5 px-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
              Login
            </a>
          @endguest

          @auth
          <div class="hs-dropdown relative md:py-4">
            <button class="flex items-center gap-x-2 font-medium text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
              {{ auth()->user()->name }}
              <svg class="w-4 h-4" fill="none" stroke="currentColor">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </button>

            <div class="hs-dropdown-menu hidden z-20 bg-white dark:bg-gray-800 shadow-md rounded-lg p-2">

              <a href="{{ route('myorders.index') }}"
                class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                My Orders
              </a>

              <a href="#"
                class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                My Account
              </a>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full text-left px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                  Logout
                </button>
              </form>

            </div>
          </div>
          @endauth


        </div>
      </div>

    </div>
  </nav>
</header>

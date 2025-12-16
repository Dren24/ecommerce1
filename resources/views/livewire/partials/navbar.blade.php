<header class="flex z-50 sticky top-0 bg-white shadow-md dark:bg-gray-800">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8 py-3" aria-label="Global">
    <div class="flex items-center justify-between">

      <!-- BRAND -->
      <a class="text-xl font-semibold dark:text-white" href="/">
        RevnoParts
      </a>

      <!-- MOBILE MENU BUTTON -->
      <button
        class="md:hidden flex items-center justify-center w-9 h-9 rounded-lg border border-gray-300 dark:border-gray-700"
        data-hs-collapse="#navbar-menu">
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
      </button>

      <!-- NAV LINKS -->
      <div id="navbar-menu" class="hidden md:block basis-full md:basis-auto">
        <div class="flex flex-col md:flex-row items-center gap-x-6 mt-4 md:mt-0 min-h-[56px]">

          <!-- SEARCH -->
          <form action="/products" method="GET" class="relative hidden lg:block mr-4">
            <input
              type="text"
              name="search"
              placeholder="Search parts..."
              class="w-56 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700
                     bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300
                     focus:outline-none focus:ring-2 focus:ring-blue-500">
          </form>

          <!-- LINKS -->
          <a href="/" class="flex items-center h-11 leading-none nav-link">Home</a>
          <a href="/categories" class="flex items-center h-11 leading-none nav-link">Categories</a>
          <a href="/products" class="flex items-center h-11 leading-none nav-link">Products</a>

          <!-- CART -->
          <a href="/cart" class="flex items-center h-11 leading-none nav-link">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5"/>
            </svg>
            Cart
            <span class="ml-2 rounded-full bg-blue-100 text-blue-600 text-xs px-1.5 py-0.5">
              {{ $total_count }}
            </span>
          </a>

          <!-- 🌙 DARK MODE TOGGLE (FIXED) -->
<button id="theme-toggle"
  class="ml-2 w-10 h-10 flex items-center justify-center rounded-full
         bg-gray-100 dark:bg-gray-700
         text-gray-700 dark:text-gray-200
         hover:bg-gray-200 dark:hover:bg-gray-600
         transition">

  <!-- Sun -->
  <svg id="theme-sun"
       class="w-5 h-5 hidden"
       viewBox="0 0 24 24"
       fill="none"
       stroke="currentColor"
       stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M12 3v2m0 14v2m9-9h-2M5 12H3m7-7a5 5 0 100 10 5 5 0 000-10z"/>
  </svg>

  <!-- Moon -->
  <svg id="theme-moon"
       class="w-5 h-5 hidden"
       viewBox="0 0 24 24"
       fill="none"
       stroke="currentColor"
       stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"/>
  </svg>
</button>


          <!-- AUTH -->
          @guest
            <a href="/login"
              class="py-2.5 px-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
              Login
            </a>
          @endguest

          @auth
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="flex items-center h-11 leading-none nav-link">Logout</button>
            </form>
          @endauth

        </div>
      </div>
    </div>
  </nav>
</header>

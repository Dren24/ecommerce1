<div>
  <div class="w-full max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 mx-auto">

      <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-gray-200 mb-10">
          Browse <span class="text-blue-600">Categories</span>
      </h1>

      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

          @foreach ($categories as $item)
          <a wire:key="{{ $item->id }}"
             href="/products?selectedCategories[0]={{ $item->id }}"
             class="group bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700
                    rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300
                    flex items-center gap-4 hover:-translate-y-1">

              {{-- Image --}}
              <div class="flex-shrink-0">
                  <img src="{{ url('storage', $item->image) }}"
                       class="h-20 w-20 rounded-xl object-cover group-hover:scale-105 transition">
              </div>

              {{-- Text --}}
              <div class="flex-1">
                  <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200
                             group-hover:text-blue-600 transition">
                      {{ $item->name }}
                  </h3>

                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                      View products →
                  </p>
              </div>

          </a>
          @endforeach

      </div>
  </div>
</div>

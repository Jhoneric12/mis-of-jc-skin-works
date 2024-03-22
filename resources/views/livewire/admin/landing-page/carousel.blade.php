@if (count($products) > 1)
<div id="default-carousel" class="relative w-full bg-[#EBF7DD] h-[45rem] md:h-[30rem] z-10" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative flex justify-center gap-4 items-center overflow-hidden rounded-lg h-full">
        @foreach ($products as $index => $product)
            <!-- Item -->
            <div class="duration-700 ease-in-out" data-carousel-item>
                <div class="flex flex-col items-center px-4 gap-4  md:flex-row md:items-center md:justify-center md:h-full">
                    <div class="w-full flex flex-col justify-center md:w-1/2">
                        <h1 class="text-primary-green font-extrabold text-xl mt-6 md:text-2xl">Featured Products</h1>
                        <p class="text-xs font-medium md:text-sm">Quality ingredients. Real results</p>
                        <p class="font-semibold text-base md:text-xl mt-6">{{$product->product_name}}</p>
                        <img src="{{ asset('storage/' . $product->product_image_path) }}" class=" md:hidden inset-0 w-[15rem] h-[15rem] mt-6 text-center" alt="Product Image">
                        <p class="text-sm mt-6 font-normal leading-6">{{$product->description}}</p>
                    </div>
                    <img src="{{ asset('storage/' . $product->product_image_path) }}" class="hidden md:block inset-0 object-cover w-[15rem] h-[15rem] mt-6" alt="Product Image">
                </div>
            </div>
        @endforeach
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        @foreach ($products as $index => $product)
            <button type="button" class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-secondary-green' : 'bg-gray-300' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
        @endforeach
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800/30 group-hover:bg-gray-50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-[#4EBB59] dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800/30 group-hover:bg-gray-50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-[#4EBB59] dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
@else
<div class="relative w-full bg-[#EBF7DD] h-screen md:h-[30rem] z-10 ">

    <div class="flex justify-center gap-4 items-center overflow-hidden rounded-lg h-full">
        @foreach ($products as $product)
            <div class="flex flex-col items-center px-4 gap-4  md:flex-row md:items-center md:justify-center md:h-full">
                <div class="w-full flex flex-col justify-center md:w-1/2">
                    <h1 class="text-primary-green font-extrabold text-xl mt-6 md:text-2xl">Featured Products</h1>
                    <p class="text-base font-medium md:text-xl">Quality ingredients. Real results</p>
                    <img src="{{ asset('storage/' . $product->product_image_path) }}" class=" md:hidden inset-0 w-[20rem] h-[20rem] mt-6 text-center" alt="Product Image">
                    <p class="text-sm mt-6 font-normal">{{$product->description}}</p>
                </div>
                <img src="{{ asset('storage/' . $product->product_image_path) }}" class="hidden md:block inset-0 object-cover w-[20rem] h-[20rem] mt-6" alt="Product Image">
            </div>
        @endforeach
    </div>
</div>
@endif
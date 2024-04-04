<div class="bg-gradient-to-bl from-[#EBF7DD] to-[#a6eead]">
    <div class="py-10 text-center flex flex-col items-center">
        <h1 class="text-primary-green text-base font-extrabold md:text-lg">Our services</h1>
        <p class="font-semibold text-lg md:text-xl">What we provide</p>
        <div class="mt-2">
            <img src="{{asset('assets/Essentials/line-title.png')}}" alt="">
        </div>
    </div>
    <div id="default-carousel" class="relative w-full bg-gradient-to-bl from-[#EBF7DD] to-[#a6eead] h-[35rem] md:h-[25rem] z-10" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative flex justify-center gap-4 items-center overflow-hidden rounded-lg h-full">
            @foreach ($services as $index => $service)
                <!-- Item -->
                <div class="duration-700 ease-in-out" data-carousel-item>
                    <div class="flex flex-col gap-10 items-center px-4 md:flex-row md:items-center md:justify-center md:h-full">
                        <div class="w-full flex flex-col justify-center md:w-1/2 lg:w-1/2 py-10">
                            <p class="font-semibold text-base md:text-xl mt-6">{{$service->service_name}}</p>
                            <img src="{{ asset('storage/' . $service->image_path) }}" class=" md:hidden inset-0 w-[15rem] h-[15rem] mt-6 text-center" alt="Product Image">
                            <p class="text-lg mt-2 font-bold leading-6 text-primary-green">P {{ number_format($service->price, 2)}}</p>
                            <p class="text-sm mt-6 leading-6 ">{{$service->description}}</p>
                        </div>
                        <img src="{{ asset('storage/' . $service->image_path) }}" class="hidden md:block inset-0 object-cover w-[30rem] h-[15rem] mt-6 shadow-lg" alt="Product Image">
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none md:hidden" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800/30 group-hover:bg-gray-50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-secondary-green dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none md:hidden" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800/30 group-hover:bg-gray-50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-secondary-green dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>

<div class="flex flex-col items-center bg-center bg-cover" style="background-image: url({{asset('assets/Essentials/desktop-bg.png')}})">
    <div class="py-10 text-center flex flex-col items-center">
        <h1 class="text-primary-green text-lg font-extrabold md:text-2xl">Dermatologist</h1>
        <p class="font-semibold text-lg md:text-xl">Meet our dermatologist</p>
        <div class="mt-2">
            <img src="{{asset('assets/Essentials/line-title.png')}}" alt="">
        </div>
    </div>
    <div>
        <img src="{{asset('storage/' . $image)}}" alt="" class="w-[20rem] h-[20rem] md:w-[30rem] md:h-[30rem]">
    </div>
    <div class="bg-white shadow-lg rounded-lg px-20 py-6 mb-10">
        <h1 class="text-primary-green font-bold">Dr. {{$dermaName}}</h1>
    </div>
</div>

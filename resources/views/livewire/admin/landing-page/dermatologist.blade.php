<div class="flex flex-col items-center bg-center bg-cover bg-[#e8eae5]">
    <div class="py-10 text-center flex flex-col items-center">
        <h1 class="text-primary-green text-lg font-extrabold md:text-lg">Dermatologist</h1>
        <p class="font-semibold text-lg md:text-xl">Meet our dermatologist</p>
        <div class="mt-2">
            <img src="{{asset('assets/Essentials/line-title.png')}}" alt="">
        </div>
    </div>
    <div class="flex justify-center">
        <img src="{{asset('storage/' . $image)}}" alt="" class="w-[20rem] h-[10rem] md:w-[20rem] md:h-[20rem]">
    </div>
    <div class="bg-white shadow-lg rounded-lg px-20 py-4 mb-10 mt-4">
        <h1 class="text-primary-green font-bold text-sm">Dr. {{$dermaName}}</h1>
    </div>
</div>

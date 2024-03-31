<div class="flex flex-col items-center bg-[#e8eae5] px-10">
    <div class="py-10 text-center flex flex-col items-center">
        <h1 class="text-primary-green text-base font-extrabold md:text-lg">About Us</h1>
        <p class="font-semibold text-lg md:text-xl">{{$title}}</p>
        <div class="mt-2">
            <img src="{{asset('assets/Essentials/line-title.png')}}" alt="">
        </div>
    </div>
    <div class="flex flex-col items-center lg:flex-row lg:justify-center lg:gap-20 gap-1 pb-10">
        <div class="lg:w-[30rem] h-[18rem]">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15448.276027238218!2d121.15164!3d14.5380454!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c78a6983a55d%3A0x18f52bb9275add02!2sJC%E2%80%99s%20Skinworks%20Derma%20Clinic!5e0!3m2!1sen!2sph!4v1711068424564!5m2!1sen!2sph" style="border:1px solid gray; width: 100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="flex flex-col items-center justify-center lg:items-start lg:w-1/2">
            <div class="mt-6 lg:mt-0">
                <p class="text-center lg:text-left text-sm md:text-base lg:text-base leading-6 lg:leading-8">{{$content}}</p>
            </div>
            <a href="{{url('register')}}" class="mt-6">
                <x-Essentials.button class="font-semibold py-2">Make Appointment</x-Essentials.button>
            </a>
        </div>
    </div>
</div>

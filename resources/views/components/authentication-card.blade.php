<div class="min-h-screen min-w-full flex flex-col justify-center items-center lg:flex lg:flex-row lg:justify-around pt-6 py-10 sm:pt-0 ">
    <div class="md:w-[24rem] h-[20rem]">
        {{ $logo }}
    </div>

    <div {{$attributes->merge(['class' => "w-full sm:max-w-3xl mt-6 px-6 py-10 bg-white shadow-md overflow-hidden sm:rounded-lg"])}}>
        {{ $slot }}
    </div>
</div>

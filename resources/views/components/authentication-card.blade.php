<div class="min-h-screen min-w-full flex flex-col sm:justify-center items-center md:flex md:flex-row md:justify-around pt-6 py-10 sm:pt-0 ">
    <div>
        {{ $logo }}
    </div>

    <div {{$attributes->merge(['class' => "w-full sm:max-w-3xl mt-6 px-6 py-10 bg-white shadow-md overflow-hidden sm:rounded-lg"])}}>
        {{ $slot }}
    </div>
</div>

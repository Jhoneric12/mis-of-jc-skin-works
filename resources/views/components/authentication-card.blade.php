<div class="min-h-screen w-full flex flex-col justify-center items-center md:grid md:grid-cols-2 md:place-items-center py-16 ">
    <div>
        {{ $logo }}
    </div>

    <div {{$attributes->merge(['class' => "w-full sm:max-w-2xl mt-6 px-6 py-10 bg-white shadow-md overflow-hidden sm:rounded-lg"])}}>
        {{ $slot }}
    </div>
</div>

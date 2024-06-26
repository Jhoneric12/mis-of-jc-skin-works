<div class="min-h-screen w-full flex flex-col justify-center items-center py-10 ">
    <div>
        {{ $logo }}
    </div>

    <div {{$attributes->merge(['class' => "w-full sm:max-w-3xl mt-6 px-6 py-10 bg-white shadow-md overflow-hidden sm:rounded-lg"])}}>
        {{ $slot }}
    </div>
</div>

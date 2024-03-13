@props(['link' => '#'])

<a href="{{$link}}" class="flex flex-col gap-6 bg-white rounded-lg shadow-md items-center py-8 w-full">
    <div class="w-14 h-14 flex-grow">
        {{$img}}
    </div>
    <div class="text-sm font-semibold">
        {{$title}}
    </div>
</a>
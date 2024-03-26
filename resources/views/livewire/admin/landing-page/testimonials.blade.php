<div class="bg-gradient-to-bl from-[#EBF7DD] to-[#a6eead]">
    <div class="py-10 text-center flex flex-col items-center">
        <h1 class="text-primary-green text-base font-extrabold md:text-lg">Testimonials</h1>
        <p class="font-semibold text-lg md:text-xl">What our clients say about us</p>
        <div class="mt-2">
            <img src="{{asset('assets/Essentials/line-title.png')}}" alt="">
        </div>
        <div class="flex flex-col justify-center lg:flex-row gap-10 mt-10 py-10">
            @foreach ($testimonials as $testimonial)
                <div class="flex flex-col items-center px-8 lg:px-20 py-8 lg:py-10 bg-white shadow-md rounded-lg">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $testimonial->patient )
                        <div class="flex-shrink-0 w-[6rem] h-[6rem] border border-gray-300 border-solid rounded-full shadow-md">
                            <img class="w-full h-full rounded-full" src="{{ $testimonial->patient->profile_photo_url }}" alt="{{ $testimonial->patient->name }}">
                        </div>
                        <div class="mt-6 text-center">
                            <div class="text-sm font-medium text-gray-900 max-w-[15rem]">{{ $testimonial->message }}</div>
                            <div class="rating rating-sm mt-2 flex gap-1 justify-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input wire:model='rating' value="{{ $i }}" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{ $testimonial->rating == $i ? 'checked' : '' }} @disabled(true) />
                                @endfor
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="text-sm font-medium text-gray-900">{{ $testimonial->first_name . " " . $testimonial->last_name }}</div>
                        </div>
                    @endif
                    <div class="mt-6 text-center">
                        <p class="text-primary-green font-semibold text-sm">{{ $testimonial->patient->first_name . " " . $testimonial->patient->last_name }}</p>
                        <p class="text-xs">{{ $testimonial->patient->home_address }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

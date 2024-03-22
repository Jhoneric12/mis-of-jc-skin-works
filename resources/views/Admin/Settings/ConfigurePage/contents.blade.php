@extends('layouts.parent')

@section('title', 'Configure Page')

@section('main-content')
    <x-Essentials.page-title>Configure Page</x-Essentials.page-title>

    <div class="grid grid-rows-4 grid-cols-4 place-items-center gap-8">   
        <x-Essentials.card :link="route('featured-products')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/features.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Featured Products</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('highlight-content')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/highlight.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Highlight Content</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('dermatologist')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/dermatologist.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Dermatologist</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('about-us')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/info.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>About Us</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('testimonials')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/testimonials.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Testimonials</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card>
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/list.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Clinic Details</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card>
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/search.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Services Overview</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('banner')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/billboard.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Promotion Banner</h1>
            </x-slot>
        </x-Essentials.card>

    </div>

@endsection
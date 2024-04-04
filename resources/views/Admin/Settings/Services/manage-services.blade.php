@extends('layouts.parent')

@section('title', 'Manage Services')

@section('main-content')
    <x-Essentials.page-title>Services</x-Essentials.page-title>

    <div class="flex gap-4">   
        <x-Essentials.card :link="route('manage-service-categories')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/category.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Manage Service Categories</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('manage-service-table')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/makeup.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Manage Services</h1>
            </x-slot>
        </x-Essentials.card>
    </div>

@endsection
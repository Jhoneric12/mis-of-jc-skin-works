@extends('layouts.parent')

@section('title', 'Manage Products')

@section('main-content')
    <x-Essentials.page-title>Products</x-Essentials.page-title>

    <div class="flex gap-4">   
        <x-Essentials.card :link="route('manage-category')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/category.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Manage Product Categories</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('manage-product-table')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/makeup.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Manage Products</h1>
            </x-slot>
        </x-Essentials.card>
    </div>

@endsection
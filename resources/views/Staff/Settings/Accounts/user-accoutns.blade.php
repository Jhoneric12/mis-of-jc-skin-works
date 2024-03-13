@extends('layouts.staff')

@section('title', 'User Accounts')

@section('main-content')
    <x-Essentials.page-title>User Accounts</x-Essentials.page-title>

    <div class="grid grid-rows-4 grid-cols-4 place-items-center gap-8">   
        <x-Essentials.card :link="route('staff-patient-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/medical.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Patient</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('staff-staff-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/employees.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Staff</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('dermatologist')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/dermatologist.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Doctors</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('about-us')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/administrator.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Administrator</h1>
            </x-slot>
        </x-Essentials.card>
    </div>
@endsection
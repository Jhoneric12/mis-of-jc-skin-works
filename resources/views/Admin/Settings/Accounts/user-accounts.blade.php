@extends('layouts.parent')

@section('title', 'User Accounts')

@section('main-content')
    <x-Essentials.page-title>User Accounts</x-Essentials.page-title>

    <div class="grid grid-rows-3 grid-cols-3 place-items-center gap-8">   
        {{-- <x-Essentials.card :link="route('patient-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/medical.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Patient</h1>
            </x-slot>
        </x-Essentials.card> --}}

        <x-Essentials.card :link="route('staff-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/employees.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Staff</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('doctor-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/dermatologist.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Doctors</h1>
            </x-slot>
        </x-Essentials.card>

        <x-Essentials.card :link="route('admin-accounts')">
            <x-slot name='img'>
                <img src="{{asset('assets/Essentials/administrator.png')}}" alt="">
            </x-slot>
            <x-slot name='title'>
                <h1>Administrator</h1>
            </x-slot>
        </x-Essentials.card>
    </div>
@endsection
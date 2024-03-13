@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#4FBD5E] focus:ring-green-500 rounded-md shadow-sm']) !!}>

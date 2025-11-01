@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge([
        'class' => 'bg-gray-800 text-gray-100 border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder-gray-400'
    ]) !!}
/>
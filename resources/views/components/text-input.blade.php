@props([
    'disabled' => false,
    'readonly' => false,
])

@php
    $class = 'border-gray-300 dark:border-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm';
    
    if ($disabled || $readonly) {
        $class .= ' text-gray-500 bg-gray-200 dark:text-gray-400 dark:bg-gray-600/30';
    } else {
        $class .= ' dark:text-gray-300 dark:bg-gray-900';
    }
    
@endphp

<input {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge([
    'class' => $class,
]) !!}>

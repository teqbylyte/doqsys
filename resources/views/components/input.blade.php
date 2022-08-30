@props(['disabled' => false, 'error' => false])

@error($attributes->get('name'))
    @php
        $error = true
    @endphp
@enderror

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' =>  !$error ? 'rounded-md shadow-sm border-cyan-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 p-2.5' : 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500']) !!} />

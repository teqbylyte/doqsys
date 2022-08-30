@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' =>  'rounded-md shadow-sm border-cyan-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 p-2.5']) !!} />

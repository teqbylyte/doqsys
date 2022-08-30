@props(['inputName'])
@error($inputName)

    <span {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600']) }}>{{ $message }}</span>

@enderror

@props(['doc', 'name' => null ])

@php
    $icon = getFileIcon($doc->type)
@endphp
<a
    @if($doc->type == 'image')
    class="elem flex items-center image-wrapper cursor-pointer hover:opacity-80"
    href="{{ $doc->path }}"
    data-lcl-thumb="{{ $doc->path }}"
    @else
    class="flex items-center"
    @endif
>
    @if($doc->type = 'image')
        <span style="background-image: url({{ $doc->path }});"></span>
    @endif

    <x-icon class="text-cyan-600">{{ $icon }}</x-icon>

    <div class="truncate pl-2">
        {{ $name ?? $doc->file_name }}
    </div>
</a>

<!-- Breadcrumb -->
@props(['breadcrumbs'])

<div class="max-w-7xl mx-auto pt-6 pb-2 sm:pb-0 px-4 sm:px-6 lg:px-8">
    @foreach($breadcrumbs as $breadcrumb)
        <span class="text-sm font-semibold">
            @if(!is_null($breadcrumb['link']))
                <a href="{{$breadcrumb['link']}}">
                    <span class="inline-flex items-center">
                        <x-icon class="pr-1 text-sm text-cyan-700">{{ $breadcrumb['icon'] }}</x-icon>
                        <span class="">{{ $breadcrumb['name']}}</span>
                        <span class="px-2">>></span>
                    </span>
                </a>
            @else
                <span>
                    <span class="inline-flex items-center">
                        <x-icon class="pr-1 text-sm text-slate-500">{{ $breadcrumb['icon'] }}</x-icon>
                        <span class="text-slate-500">{{ $breadcrumb['name']}}</span>
                    </span>
                </span>
            @endif
        </span>
    @endforeach
</div>

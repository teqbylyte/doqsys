@props(['folders'])

<div class="p-6 bg-white border-b max-h-96 overscroll-y-auto border-gray-200">
    @if(!is_null($folders))
        <div class="grid lg:grid-cols-8 md:grid-cols-6 sm:grid-cols-4 grid-cols-3 lg:gap-10 gap-5">

                @foreach($folders as $folder)
                    <div class="relative flex flex-col justify-start">
                        <a href="{{route('folders.show', $folder->slug)}}" class="p-0 m-0">
                            <span class="material-icons text-8xl text-cyan-200 hover:text-cyan-100 mr-2">folder</span>
                        </a>
                        <div class="flex justify-between w-24">
                            <a href="{{route('folders.show', $folder->slug)}}" class="truncate hover:text-gray-500">{{ $folder->name }}</a>
                            <div class="">
                                <x-dropdown align="right" width="36">
                                    <x-slot:trigger>
                                        <span class="material-icons text-xs text-dark hover:text-dark cursor-pointer">more_vert</span>
                                    </x-slot:trigger>

                                    <x-slot:content>

                                        <!-- Modal dropdown button -->
                                        <x-dropdown-button class="hover:text-blue-400 text-blue-600"
                                                           data-modal-toggle="rename-folder-{{$folder->slug}}"
                                        >
                                            Rename
                                        </x-dropdown-button>
                                        @can('modify folder')
                                            <form method="POST" action="{{ route('folders.delete', [$folder->slug]) }}">
                                                @method('delete')
                                                @csrf
                                                <x-dropdown-link class="hover:text-red-400 text-red-600"
                                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                >
                                                    Delete
                                                </x-dropdown-link>
                                            </form>
                                        @endcan
                                    </x-slot:content>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>

                @endforeach
        </div>
    @else
        <p class="text-center text-sm text-slate-500 font-semibold">No folders</p>
    @endif
</div>

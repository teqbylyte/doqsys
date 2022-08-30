@props(['folders'])

<div class="p-6 bg-white border-b max-h-96 overflow-y-scroll border-gray-200">
    <div class="grid lggrid-cols-8 md:grid-cols-6 sm:grid-cols-4 grid-cols-2 lg:gap-10 gap-5">

        @foreach($folders as $folder)
            <div class="relative flex flex-col justify-start">
                <a href="{{route('folders.show', $folder->slug)}}" class="p-0 m-0">
                    <span class="material-icons text-8xl text-cyan-200 hover:text-cyan-100 mr-2">folder</span>
                </a>
                <div class="flex justify-between w-full">
                    <a href="{{route('folders.show', $folder->slug)}}" class="truncate hover:text-gray-500">{{ $folder->name }}</a>
                    <div class="mr-4 sm:mr-0">
                        <x-dropdown align="right" width="36">
                            <x-slot:trigger>
                                <span class="material-icons text-xs text-dark hover:text-dark cursor-pointer">more_vert</span>
                            </x-slot:trigger>

                            <x-slot:content>
                                <x-dropdown-link method="post" as="button"
                                                 class="hover:text-blue-400 text-blue-600"
                                >
                                    Rename
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('folders.delete', [$folder->slug])" method="post" as="button"
                                                 class="hover:text-red-400 text-red-600"
                                >
                                    Delete
                                </x-dropdown-link>
                            </x-slot:content>
                        </x-dropdown>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

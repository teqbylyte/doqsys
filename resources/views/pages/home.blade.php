<x-app-layout>
    @section('page-css')
        <x-dropify-css />
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <!-- Page Body--->


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Modal Buttons--->
            <div class="flex justify-end  mb-5">
                <x-button-light type="button" class="mx-2" data-modal-toggle="file-modal">
                    <x-icon class="text-cyan-600 mr-2">upload_file</x-icon>
                    Upload File
                </x-button-light>
                <x-button type="button" class="mx-2" data-modal-toggle="folder-modal">
                    <x-icon class="text-white mr-2">create_new_folder</x-icon>
                    New Folder
                </x-button>
            </div>
            <!-- Modal Buttons end--->

            <!-- Greeting--->
            <div class="overflow-hidden">
                <p><strong>Hey there!</strong></p>
                @if($documents->count() < 1 && $folders->count() < 1)
                    <p class="pt-2 sm:pt-5">Welcome to the home your documents manager, proceed to upload documents, create folders to group your documents and easily access/manage them for your organization.</p>
                @endif
            </div>
            <!-- Greeting End--->

            <!-- Latest-->
            @if($latest->count() > 0)
                <div class="mt-10 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">
                        Recently Added
                        <span class="text-sm text-slate-500">(Click on images to view)</span>
                    </h3>
                    <div class="pb-6 pt-1 max-h-80 overflow-y-scroll grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
                        @foreach($latest as $doc)
                            <div class="bg-white p-4 shadow-sm rounded-sm flex justify-between">
                                <div class="flex items-center @if($doc->type == 'image') cursor-pointer hover:opacity-80 @endif">
                                    <x-icon class="text-cyan-600">{{ getFileIcon($doc->type) }}</x-icon>
                                    <div class="truncate pl-2">
                                        {{ $doc->file_name }}
                                    </div>
                                </div>
                                <x-dropdown align="right" width="36">
                                    <x-slot:trigger>
                                        <span class="material-icons text-xs text-dark hover:text-dark cursor-pointer">more_vert</span>
                                    </x-slot:trigger>

                                    <x-slot:content>

                                        <!-- Modal dropdown button -->
                                        <x-dropdown-link class="hover:text-green-400 text-green-600"
                                                         href="{{ route('documents.download', $doc->uuid) }}"
                                        >
                                            Download
                                        </x-dropdown-link>
                                        @can('modify document')
                                            <form method="POST" action="{{ route('documents.delete', $doc->uuid) }}">
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
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Folders-->
            @if($folders->count() > 0)
                <div class="mt-10 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">Folders</h3>
                    <x-folder-list :folders="$folders" />
                </div>
            @endif

        <!-- Documents -->
            @if($documents->count() > 0)
                <div class="mt-10 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">Documents</h3>
                    <x-doc-list :docs="$documents" />
                </div>
            @endif
        </div>
    </div>

    <!-- Page Modals--->
    <div>
        <x-modal-form modal-id="file-modal" route="{{ route('documents.store') }}" enctype="multipart/form-data">
            <x-slot:heading>Upload File</x-slot:heading>
            <div class="flex flex-col mb-5">
                <x-label for="file" class="pb-1">Name</x-label>
                <input type="file" id="file" name="file" class="dropify"
                       data-max-file-size="5M" required
                />
                <x-input-error :inputName="$error = 'file'" />
            </div>
        </x-modal-form>

        <x-modal-form modal-id="folder-modal" :route="route('folders.store')">
            <x-slot:heading>Add New Folder</x-slot:heading>
            <div class="flex flex-col mb-5">
                <x-label for="name" class="pb-1">Name</x-label>
                <x-input id="name" class="block mt-0 px-2 w-full h-10 border border-cyan-400"
                         name="name" value="{{ old('name') }}" autofocus required
                />
                <x-input-error :inputName="$error = 'name'" />
            </div>
        </x-modal-form>

        @if($folders->count() > 0)
            @foreach($folders as $folder)
                <x-modal-form modal-id="rename-folder-{{$folder->slug}}" :route="route('folders.update', $folder->slug)">
                    <x-slot:heading>Rename Folder</x-slot:heading>
                    <div class="flex flex-col mb-5">
                        <x-label for="name" class="pb-1">Name</x-label>
                        <x-input id="name" class="block mt-0 px-2 w-full h-10 border border-cyan-400"
                                 name="name" value="{{ old('name') ?? $folder->name }}" autofocus required
                        />
                        <x-input-error :inputName="$error = 'name'" />
                        <input type="hidden" name="super_folder" value="{{ $folder->superFolder?->slug }}">
                    </div>
                </x-modal-form>
            @endforeach
        @endif

        @if($documents->count() > 0)
            @foreach($documents as $document)
                <x-modal-form modal-id="rename-doc-{{$document->uuid}}" :route="route('documents.update', $document->uuid)">
                    <x-slot:heading>Rename Folder</x-slot:heading>
                    <div class="flex flex-col mb-5">
                        <x-label for="name" class="pb-1">Name</x-label>
                        <x-input id="name" class="block mt-0 px-2 w-full h-10 border border-cyan-400"
                                 name="name" value="{{ old('name') ?? $document->name }}" autofocus required
                        />
                        <x-input-error :inputName="$error = 'name'" />
                        <input type="hidden" name="super_folder" value="{{ $document->folder?->slug }}">
                    </div>
                </x-modal-form>
            @endforeach
        @endif
    </div>
<!-- Page Modals End--->
    <!-- Page Body End--->

    @section('page-scripts')
        <x-dropify-script />
        <script>

        </script>
    @endsection

</x-app-layout>

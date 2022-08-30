<x-app-layout>
    @section('page-css')
        <x-dropify-css />
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Folder | '. $folder->name) }}
        </h2>
    </x-slot>

    <!-- Page Body--->
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"/>

    <!-- Modal Buttons--->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Folders-->
            <div class="mt-10 shadow-sm sm:rounded-lg">
                <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">Folders</h3>
                <x-folder-list :folders="$folder->subFolders" />
            </div>

            @php
                $docs = $folder->documents
            @endphp
            <!-- Documents-->
            <div class="mt-10 shadow-sm sm:rounded-lg">
                <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">Folders</h3>
                <x-doc-list :docs="$docs" />
            </div>
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
                    <input type="hidden" name="folder" value="{{ $folder->slug }}">
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
                    <input type="hidden" name="super_folder" value="{{ $folder->slug }}">
                </div>
            </x-modal-form>

            @if(!is_null($folder->subFolders))
                @foreach($folder->subFolders as $folder)
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

            @if(!is_null($docs))
                @foreach($docs as $document)
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
    @endsection

</x-app-layout>

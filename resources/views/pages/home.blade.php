<x-app-layout>
    @section('page-css')
        <x-dropify-css />
        <x-img-viewer-css />
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <!-- Page Body--->


    <div class="py-12 mx-3 sm:mx-0">
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

            <!-- Recently Uploaded-->
            @if($latest->count() > 0)
                <div class="mt-10">
                    <h3 class="font-bold text-md text-cyan-600 pl-3 pb-3">
                        Recently Added
                        <span class="text-sm text-slate-500">(Click on images to view)</span>
                    </h3>
                    <div class="pb-6 pt-1 max-h-80 md:max-h-96 overflow-y-scroll px-3 md:px-0 grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
                        @foreach($latest as $doc)
                            <div class="bg-white p-4 shadow-sm rounded-sm flex justify-between">
                                <x-doc-name :doc="$doc" />

                                <div>
                                    <a href="{{ route('documents.download', $doc->uuid) }}" class="px-1 ">
                                        <x-icon class="text-sm text-green-600 hover:text-green-400">download</x-icon>
                                    </a>
                                    @can('modify document')
                                        <form method="POST" class="inline px-1" action="{{ route('documents.delete', $doc->uuid) }}">
                                            @method('delete')
                                            @csrf
                                            <span class="hover:text-red-400 text-red-600"
                                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                            >
                                                <x-icon class="text-sm text-red-600 hover:text-red-400 cursor-pointer">delete_forever</x-icon>
                                            </span>
                                        </form>
                                    @endcan
                                </div>
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
                    <div class="text-sm text-cyan-600 pl-6 pb-3">
                        <div class="flex items-center ">
                            <h3 class="font-bold text-md text-cyan-600">Documents</h3>
                            @can('modify document')
                                <a href="{{ route('hidden') }}" data-tooltip-target="hidden-tooltip">
                                    <x-icon class="text-lg text-cyan-600 hover:text-cyan-400 mx-2">{{ showHidden() ? 'visibility' : 'visibility_off' }}</x-icon>
                                </a>
                                <div id="hidden-tooltip" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                                    {{ showHidden() ? 'Don\'t show hidden' : 'Show Hidden' }}
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            @endcan
                        </div>

                        @can('modify document')
                            <p class="text-xs text-slate-400"><em>Hidden files are shown at the bottom of the list when enabled.</em></p>
                        @endcan
                    </div>
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

                    @method('put')
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
                    <x-slot:heading>Rename Document</x-slot:heading>

                    @method('put')
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
        <x-img-viewer-script />
        <script>

        </script>
    @endsection

</x-app-layout>

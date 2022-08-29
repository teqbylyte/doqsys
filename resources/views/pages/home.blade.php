<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <x-modal-form modal-id="file-modal" action="#">
        <x-slot:heading>Upload File</x-slot:heading>
        <div>Hi</div>
    </x-modal-form>

    <x-modal-form modal-id="folder-modal" :action="route('folders.store')">
        <x-slot:heading>Add New Folder</x-slot:heading>
        <div class="flex flex-col mb-3">
            <x-label for="name" class="pb-1">Name</x-label>
            <x-input id="name" class="block mt-0 px-2 w-full h-10 border border-cyan-400" name="name"/>
        </div>

    </x-modal-form>

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
        </div>
    </div>


</x-app-layout>

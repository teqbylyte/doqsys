<x-app-layout>
    @section('page-css')
        <x-dropify-css />
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Users
        </h2>
    </x-slot>

    <!-- Page Body--->
    <!-- Modal Buttons--->
        <div class="pb-12 pt-3">
            <div class="max-w-7xl mx-3 sm:mx-auto sm:px-6 lg:px-8">

                <h3 class="font-bold text-xl">Showing all permissions and their assigned users</h3>

                <!-- List of Users -->
                @if(!empty($users))
                    @foreach($users as $key => $value)
                        <div class="my-10 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex text-sm text-cyan-600 pl-3 pb-3">
                                <h3 class="font-bold pt-2 text-xs uppercase">{{ $key }} Permission</h3>
                                @if($key != 'not given')
                                    <a href="{{route('users.give-permission', ['permission' => $key])}}">
                                        <x-icon class="text-lg text-cyan-600 mx-2">person_add</x-icon>
                                    </a>
                                @endif

                            </div>

                            <div class="overflow-x-auto max-h-80 overflow-y-scroll relative shadow-sm sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 font-semibold uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">Name</th>
                                        <th scope="col" class="py-3 px-6">Email</th>
                                        <th v-if="permission_name !== no_permission" scope="col" class="py-3 px-6">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($value->count() > 0)
                                            @foreach($value as $user)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">{{ $user->name }}</th>
                                                    <td class="py-4 px-6">{{ $user->email }}</td>
                                                    <td v-if="permission_name !== no_permission" class="py-4 px-6">
                                                        <form method="POST" action="{{ route('users.revoke-permission') }}">
                                                            @method('delete')
                                                            @csrf
                                                            <input type="hidden" name="email" value="{{ $user->email }}">
                                                            <input type="hidden" name="permission" value="{{ $key }}">
                                                            <a class="hover:text-red-400 text-red-600 hover:underline"
                                                               onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                            >
                                                                Delete
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="4">No User.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    <!-- Page Modals--->
        <div>
{{--            <x-modal-form modal-id="file-modal" route="{{ route('documents.store') }}" enctype="multipart/form-data">--}}
{{--                <x-slot:heading>Upload File</x-slot:heading>--}}
{{--                <div class="flex flex-col mb-5">--}}
{{--                    <x-label for="file" class="pb-1">Name</x-label>--}}
{{--                    <input type="file" id="file" name="file" class="dropify"--}}
{{--                           data-max-file-size="5M" required--}}
{{--                    />--}}
{{--                    <x-input-error :inputName="$error = 'file'" />--}}
{{--                    <input type="hidden" name="folder" value="{{  }}">--}}
{{--                </div>--}}
{{--            </x-modal-form>--}}

<!-- Page Modals End--->

    <!-- Page Body End--->

    @section('page-scripts')
        <x-dropify-script />
    @endsection

</x-app-layout>

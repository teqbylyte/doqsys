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
                                    <button type="button" data-modal-toggle="{{ str($key)->slug() }}">
                                        <x-icon class="text-lg text-cyan-600 mx-2">person_add</x-icon>
                                    </button>
                                @endif
                            </div>

                            <div class="overflow-x-auto max-h-80 overflow-y-scroll relative shadow-sm sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 font-semibold uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">Name</th>
                                        <th scope="col" class="py-3 px-6">Email</th>
                                        @if($key != 'not given')
                                            <th scope="col" class="py-3 px-6">Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($value->count() > 0)
                                            @foreach($value as $user)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">{{ $user->name }}</th>
                                                    <td class="py-4 px-6">{{ $user->email }}</td>
                                                    @if($key != 'not given')
                                                        <td class="py-4 px-6">
                                                            <form method="POST" action="{{ route('users.revoke-permission') }}">
                                                                @csrf
                                                                <input type="hidden" name="email" value="{{ $user->email }}">
                                                                <input type="hidden" name="permission" value="{{ $key }}">
                                                                <a class="hover:text-red-400 text-red-600 hover:underline cursor-pointer"
                                                                   onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                                >
                                                                    Remove
                                                                </a>
                                                            </form>
                                                        </td>
                                                    @endif
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

                        <div>
                            <x-modal-form modal-id="{{ str($key)->slug() }}" route="{{ route('users.grant-permission') }}">
                                <x-slot:heading>
                                    <span class="uppercase text-cyan-600 text-sm font-semibold">Grant Permission to {{ $key }}</span>
                                </x-slot:heading>

                                <div class="flex flex-col mb-5">
                                    <x-label for="file" class="pb-1">Email</x-label>
                                    <x-input id="email" name="email" autofocus required
                                             class="block mt-0 px-2 w-full h-10 border border-cyan-400"
                                             value="{{ old('name') }}"
                                             placeholder="Enter the user email"
                                    />
                                    <x-input-error :inputName="$error = 'email'" />
                                    <input type="hidden" name="permission" value="{{ $key }}">
                                </div>
                            </x-modal-form>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>

<!-- Page Modals End--->

    <!-- Page Body End--->

    @section('page-scripts')
        <x-dropify-script />
    @endsection

</x-app-layout>

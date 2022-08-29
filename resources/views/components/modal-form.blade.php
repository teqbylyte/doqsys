@props(['modalId', 'action'])

<!-- Main modal -->
<div id="{{ $modalId }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-cyan-600">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{ $heading }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="{{ $modalId }}">
                    <x-icon class="text-slate-400 hover:text-slate-300">close</x-icon>
                </button>
            </div>
            <!-- Modal body -->
            <form class="pb-6 px-10 pt-2 space-y-6 space-x-2" action="{{ $action }}" method="post">
                @csrf

                {{ $slot }}
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                    <button type="submit" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                    <button data-modal-toggle="{{ $modalId }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-cyan-300 rounded-lg border border-cyan-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

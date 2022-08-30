@props(['errors'])

@if ($errors->any())
    <div class="fixed fixed top-5 left-1/2 -translate-x-1/2 w-96">
        <div id="validation-error" class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-red-200 rounded-lg shadow" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <x-icon class="text-red-500">error_outline</x-icon>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ml-3">
                <div class="text-xs font-bold text-red-700">Failed to Submit!</div>
                <div class="text-sm font-normal text-red-600">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-400 text-gray-200 hover:text-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-red-300 inline-flex h-8 w-8" data-dismiss-target="#validation-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </div>
@endif

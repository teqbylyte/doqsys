@props(['status' => null])

<div class="fixed fixed top-5 left-1/2 -translate-x-1/2 w-96">
    @if($status)
        <div id="toast-status" class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-cyan-300 rounded-lg shadow" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-purple-500 bg-purple-100 rounded-lg">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3">
                <div class="text-xs font-bold text-purple-700">Message!</div>
                <div class="text-sm font-normal text-purple-600">{{ $status }}</div>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-cyan-500 text-gray-200 hover:text-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-cyan-400 inline-flex h-8 w-8" data-dismiss-target="#toast-status" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    @if (session()->has('success'))
        <div id="toast-success" class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-cyan-300 rounded-lg shadow" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3">
                <div class="text-xs font-bold text-green-700">Success!</div>
                <div class="ml-3 text-sm font-normal text-green-600">{{ session('success') }}</div>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-cyan-500 text-gray-200 hover:text-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-cyan-400 inline-flex h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div id="toast-error" class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-cyan-300 rounded-lg shadow" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ml-3">
                <div class="text-xs font-bold text-red-700">Error!</div>
                <div class="ml-3 text-sm font-normal text-red-600">{{ session('error') }}</div>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-cyan-500 text-gray-200 hover:text-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-cyan-400 inline-flex h-8 w-8" data-dismiss-target="#toast-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    @if(session()->has('message'))
        <div id="toast-message" class="flex items-center p-4 w-full max-w-xs text-gray-500 bg-cyan-300 rounded-lg shadow" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-purple-500 bg-purple-100 rounded-lg ">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ml-3">
                <div class="text-xs font-bold text-purple-700">Message!</div>
                <div class="ml-3 text-sm font-normal text-purple-600">{{ session('message') }}</div>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-cyan-500 text-gray-200 hover:text-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-cyan-400 inline-flex h-8 w-8" data-dismiss-target="#toast-message" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif
</div>

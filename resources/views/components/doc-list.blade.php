@props(['docs'])

<div class="overflow-x-auto relative shadow-sm sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 font-semibold uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Name</th>
            <th scope="col" class="py-3 px-6">Date Added</th>
            <th scope="col" class="py-3 px-6">Action</th>
        </tr>
        </thead>
        <tbody>
        @if($docs->count() > 0)
            @foreach(collect($docs)->sortByDesc('is_visible') as $doc)
                <tr class="bg-white border-b hover:bg-gray-50 @if(!$doc->is_visible) bg-opacity-60 opacity-60 @endif">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                        <x-doc-name :doc="$doc" />
                    </th>
                    <td class="py-4 px-6"> {{ dateFormat($doc->created_at)}} </td>

                    <td class="py-4 px-6">
                        <a href="{{route('documents.download', [$doc->uuid])}}" class="text-green-500 hover:text-green-400 px-2 hover:underline text-xs font-semibold">Download</a>
                        <button type="button" data-modal-toggle="rename-doc-{{$doc->uuid}}"
                                class="text-indigo-600 hover:text-indigo-500 px-2 hover:underline text-xs font-semibold"
                        >
                        Rename
                        </button>
                        @can(['modify document', 'modify folder'])
                            <form method="POST" class="inline" action="{{ route('documents.set-visibility', [$doc->uuid]) }}">
                                @method('put')
                                @csrf
                                <span class="text-blue-600 hover:text-blue-500 px-2 hover:underline text-xs font-semibold cursor-pointer"
                                      onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                >
                                    {{ $doc->is_visible ? 'Hide' : 'Show' }}
                                </span>
                            </form>

                            <form method="POST" class="inline" action="{{ route('documents.delete', [$doc->uuid]) }}">
                                @method('delete')
                                @csrf
                                <span class="text-red-600 hover:text-red-500 px-2 hover:underline text-xs font-semibold cursor-pointer"
                                      onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                >
                                    Delete
                                </span>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="3">You have not uploaded any document in this folder.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

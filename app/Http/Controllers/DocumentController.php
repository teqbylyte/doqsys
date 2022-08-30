<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\DocRequest;
use App\Models\Document;
use App\Models\Folder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function store(DocRequest $request)
    {
        try {
            $folder = Folder::slug($request->folder)->first();

            $document = FileHelper::processFileUpload(file: $request->file, folder: $folder);
            $document['type'] = FileHelper::getType($document['extension']);
            $document['folder_id'] = $folder?->id;

            Document::query()->create($document);

            return back()->with('success', 'Document Uploaded!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    /**
     * Download resource
     * @param Document $doc
     * @return RedirectResponse|StreamedResponse
     */
    public function download(Document $doc): StreamedResponse|RedirectResponse
    {
        if (!is_null($doc->path)) {
            if(Storage::disk('public')->exists($doc->path)){
                return Storage::disk('public')->download($doc->path, $doc->full_name);
            }
        }

        return back()->with('message', 'File not found');
    }
}

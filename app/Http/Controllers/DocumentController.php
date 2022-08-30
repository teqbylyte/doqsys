<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\DocRequest;
use App\Models\Document;
use App\Models\Folder;

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
}

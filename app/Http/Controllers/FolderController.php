<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Http\Requests\FolderRequest;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    public function store(FolderRequest $request)
    {
        try {
            $data = [];

            $data['folder_id'] = Folder::slug($request->super_folder)->first()?->id;
            $data['name'] = General::generateName(model: new Folder(), column: 'name', value: $request->name, super_folder: $data['folder_id']);
            $data['slug'] = str($data['name'])->slug() . time();

            Folder::query()->create($data);

            return back()->with('success', 'Folder created!');
        } catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    public function update(FolderRequest $request, string $slug)
    {
        try {
            $folder = Folder::slug($slug)->firstOrFail();

            $name = General::generateName(model: new Folder(), column: 'name', value: $request->name, super_folder: $folder->super_folder?->id);

            $folder->name = $name;
            $folder->save();

            return back()->with('success', 'Folder name updated.');
        } catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    /**
     * @throws \Throwable
     */
    public function delete(string $slug)
    {
        $folder = Folder::slug($slug)->with(['subFolders', 'documents'])->first();

        $folder->deleteOrFail();

        return back()->with('success', 'Deleted!');
    }

}

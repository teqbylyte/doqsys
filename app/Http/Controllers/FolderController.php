<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Http\Requests\FolderRequest;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    private array $breadcrumbs = [];

    public function show($slug)
    {
        $folder = Folder::slug($slug)->with(['subFolders', 'documents'])->firstOrFail();

        $this->setNestedFolders($folder);
        $breadcrumbs = $this->getBreadcrumbs(array_reverse($this->breadcrumbs));

        return view('pages.folder', compact('folder', 'breadcrumbs'));
    }

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

            $name = General::generateName(model: new Folder(), column: 'name', value: $request->name, super_folder: $folder->superFolder?->id);

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

    /**
     * Creating nesting of folders by checking if super-folders exist as the tree goes up.
     * @param Folder|Model $folder
     */
    private function setNestedFolders(Folder|Model $folder): void
    {
        $this->breadcrumbs[] = ['link' => route('folders.show', [$folder->slug]), 'name' => $folder->name, 'icon' => 'folder'];

        if ($folder->superFolder()->exists()) {
            self::setNestedFolders($folder->superFolder);
        }

//        removes the breadcrumb link from the current folder.
        $this->breadcrumbs[0]['link'] = null;
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Document;
use App\Models\Folder;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Document::query()->latest()->limit(8)->visible()->get();
        $folders = Folder::query()->whereNull('folder_id')->get();
        $documents = Document::query()->latest()->whereNull('folder_id')->visible()->get();
        $breadcrumbs = $this->getBreadcrumbs(home_link: false);

        return view('pages.home', compact('latest', 'folders', 'documents', 'breadcrumbs'));
    }

    public function hidden()
    {
        setHidden();

        $msg = showHidden() ? 'You enabled showing hidden documents' : 'You disabled showing hidden documents';
        return back()->with('message', $msg);
    }
}

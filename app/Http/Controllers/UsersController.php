<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Http\Requests\PermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $users = [];
        $permissions = General::getAllPermissions();

        collect($permissions)->each(function ($permission) use (&$users) {
            $users[$permission] = User::permission($permission)->get();
        });

        //        users not given any permission
        $users['not given'] = User::withCount('permissions')->has('permissions', 0)->get();

        $breadcrumbs = $this->getBreadcrumbs([[
            'link'  => null,
            'name'  => 'Manage Users',
            'icon'  => 'people_alt'
        ]]);

        return view('pages.users', compact('users', 'breadcrumbs'));
    }

    public function givePermission()
    {
        $permission = \request()->permission;

        return Inertia::render('Permission', compact('permission'));
    }

    public function grantPermission(PermissionRequest $request)
    {
        try {
            $permission = $request->permission;

            $user = User::query()->where('email', $request->email)->first();

            $user->givePermissionTo($permission);

            return back()->with('success', "$user->email now has permission to $permission.");
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    public function revokePermission(PermissionRequest $request)
    {
        try {
            $user = User::query()->where('email', $request->email)->first();

            $user->revokePermissionTo($request->permission);

            return back()->with('success', "$user->email permission revoked.");
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Manage Users - Online Store';
        $viewData['users'] = User::query()->orderBy('name')->get();

        return view('admin.users.index')->with('viewData', $viewData);
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        abort_if($request->user()->getId() === $user->getId(), 422, 'You cannot change your own role.');

        $user->setRole($request->validated('role'));
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'User role updated successfully.');
    }
}

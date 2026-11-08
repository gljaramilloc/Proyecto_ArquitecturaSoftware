<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * Display the list of users for administration.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.manage_users');
        $viewData['users'] = User::query()->orderBy('name')->get();

        return view('admin.users.index')->with('viewData', $viewData);
    }

    /**
     * Update a user's role.
     */
    public function updateRole(UpdateUserRoleRequest $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        abort_if($request->user()->getId() === $user->getId(), 422, __('admin.cannot_change_own_role'));

        $user->setRole($request->validated('role'));
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('status', __('admin.role_updated'));
    }
}

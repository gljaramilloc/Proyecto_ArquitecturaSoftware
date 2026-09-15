<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(): View
    {
        $viewData = [];
        $viewData['title'] = __('profile.title');
        $viewData['user'] = Auth::user();

        return view('profile.edit')->with('viewData', $viewData);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->updateProfile(
            $request->validated('name'),
            $request->validated('lastNames'),
            $request->validated('phoneNumber'),
        );

        if ($request->filled('address')) {
            $user->updateAddress($request->validated('address'));
        }

        return redirect()->route('profile.edit')->with('success', __('profile.updated'));
    }
}

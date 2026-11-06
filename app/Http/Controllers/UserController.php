<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()->latest()->paginate(20)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'role' => ['required', 'in:'.implode(',', [User::ROLE_SUPER_ADMIN, User::ROLE_CLUB_LEADER, User::ROLE_STUDENT])],
        ]);

        $user->update(['role' => $request->input('role')]);

        return back()->with('success', 'User role updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}

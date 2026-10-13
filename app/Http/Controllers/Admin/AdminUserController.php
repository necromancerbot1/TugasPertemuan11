<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('role', 'orders');
        return view('admin.users.show', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Admin tidak bisa mengubah role dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role diri sendiri.');
        }

        $user->update(['role_id' => $request->role_id]);

        return back()->with('success', 'Role user berhasil diubah.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('error', 'User berhasil dihapus.');
    }
}

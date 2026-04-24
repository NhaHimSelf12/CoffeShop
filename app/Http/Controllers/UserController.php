<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function toggleRole(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->role = ($user->role === 'admin') ? 'staff' : 'admin';
        $user->save();

        return back()->with('success', "User role updated to {$user->role}.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return back()->with('success', 'User account deactivated.');
    }

    public function updateImage(Request $request, User $user)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->store('avatars', 'public');
        $user->save();

        return back()->with('success', "{$user->name}'s profile photo updated successfully.");
    }

    public function deleteImage(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
            $user->save();
        }

        return back()->with('success', "{$user->name}'s profile photo removed.");
    }
}

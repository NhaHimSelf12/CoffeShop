<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;



class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::all();
        return view('story', compact('members'));
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $member = TeamMember::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'member_' . $id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/team');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);

            // Delete old custom image (keep seed defaults)
            $defaults = ['ceo.png', 'barista.png', 'manager.png', 'relations.png'];
            if ($member->image) {
                $basename = basename($member->image);
                if (!in_array($basename, $defaults)) {
                    $oldPath = public_path($member->image);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }

            $member->image = 'images/team/' . $name;
            $member->save();

            return back()->with('success', "{$member->name}'s photo updated successfully!");
        }

        return back()->with('error', 'Image upload failed.');
    }

    public function deleteImage($id)
    {
        $member = TeamMember::findOrFail($id);

        if ($member->image) {
            $oldPath = public_path($member->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
            $member->image = null;
            $member->save();
        }

        return back()->with('success', "{$member->name}'s photo removed.");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'bio'  => 'nullable|string|max:300',
        ]);

        $member = TeamMember::findOrFail($id);
        $member->name = $request->name;
        $member->role = $request->role;
        $member->bio  = $request->bio;
        $member->save();

        return back()->with('success', "Member info updated successfully.");
    }
}

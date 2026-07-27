<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('gender')->get();
        return view('users.index', compact('users'));
    }
    public function user()
    {
        User::all();
    }
    public function edit($id)
    {
        $user = User::with('gender')->findOrFail($id);

        $genders = Gender::all();

        return view('users.edit', compact('user', 'genders'));
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::disk('public')->exists('img/' . $user->avatar)) {
                Storage::disk('public')->delete('img/' . $user->avatar);
            }

            $image = $request->file('avatar');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('img', $imageName, 'public');

            $user->avatar = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender_id = $request->gender_id;
        $user->role = $request->role;
        $user->disable = $request->disable ?? 0;

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'User updated successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth()->user()->id;

        $myprofiles = User::where('id', $user_id)->get();
        return view('profile.index', compact('myprofiles'));
    }
    public function getProfile($id)
    {
        $myprofile = User::find($id);
        return view('profile.edit', [
            'myprofile' => $myprofile
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8|confirmed|string'
        ]);

        $myprofile = User::find($id);

        $myprofile->update([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        Alert::success('success', 'Profile kamu berhasil diubah');

        return redirect()->route('index.myprofile');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Alert::success('success', 'Akun telah didelete ');
    }
}

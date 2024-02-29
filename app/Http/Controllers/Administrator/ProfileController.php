<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
       $this->middleware('admin');
    }
    public function index()
    {
        $user_id = Auth()->user()->id;

        $myprofiles = User::where('id', $user_id)->get();
        return view('administrator.profile.index', compact('myprofiles'));
    }
    public function getProfile($id)
    {
        $myprofile = User::find($id);
        return view('administrator.profile.get-profile', [
            'myprofile' => $myprofile
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'password' => ['required', 'min:8', 'confirmed', 'string'],  
        ]);
    
        $myprofile = User::find($id);
    
        $myprofile->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
    
        Alert::success('success', 'Profile kamu berhasil diubah');
    
        return redirect()->route('administrator.index.my-profile');
    }
}

<?php

namespace App\Http\Controllers\Administrator;

use App\Role;
use App\Imports\RolesImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $roles = Role::all();

        return view('administrator.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->validate([
            'name_role' => 'required',
            'created_at' =>'nullable',
            'updated_at' => 'nullable'
        ]);

        Role::create($role);

        Alert::success('Success', 'Berhasil menambahkan role baru!');
        return redirect()->route('index.role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('administrator.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('administrator.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $request->validate([
            'name_role' => 'required'
        ]);

        $role->update([
            'name_role' => $request->name_role
        ]);
        Alert::success('Success', 'Kamu Berhasil Merubah Data!');

        return redirect()->route('index.role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();
        Alert::success('Success', 'Kamu Berhasil Hapus Data!');
        return back();
    }
}

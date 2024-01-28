<?php

namespace App\Http\Controllers\Administrator;

use App\CutiForm;
use App\CutiAccept;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CutiAcceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cutiAccepts = CutiAccept::all();

        return view('administrator.cuti-accept.index', [
            'cutiAccepts' => $cutiAccepts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cutiAccept = CutiAccept::find($id);

        return view(
            'administrator.cuti-accept.edit',
            [
                'cutiAccept' => $cutiAccept
            ]
        );
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
        $request->validate([
            'comment' => 'required'
        ]);

        $userApprove = Auth()->user()->name;
    
       $cutiAccept = CutiAccept::find($id);

       $cutiAccept->update([
        'status' => $request->input('comment'),
        'comment' => $request->input('comment') . 'By '. $userApprove,
       ]);
    
        Alert::success('success', 'Data berhasil diubah');
        return redirect()->route('administrator.index.cuti-accept');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

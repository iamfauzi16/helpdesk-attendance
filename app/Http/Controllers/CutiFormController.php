<?php

namespace App\Http\Controllers;

use App\CutiForm;
use App\CutiAccept;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CutiFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;

        $cutiforms = CutiForm::where('user_id', $user_id)->get();

        return view('cuti-form.index', [
            'cutiforms' => $cutiforms
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
        $request->validate([
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'reason' => 'required'
        ]);

        $user_id = Auth()->user()->id;

        $cutiForm = CutiForm::create([
            'user_id' => $user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' =>$request->reason,
        ]);

        $cutiForm->cutiAccept()->create([
            'cuti_form_id' => '2',
            'status'=> "Pending",
            'comment' => "Waiting A Approval"
        ]);
       
        

        Alert::success('success', 'Pengajuan berhasil dibuat');

        return redirect()->route('cuti-form.index');
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
        //
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
        //
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

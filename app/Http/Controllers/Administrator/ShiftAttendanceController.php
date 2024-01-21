<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use App\Location;
use App\ShiftAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
       return $this->middleware('admin');
    }
    public function index()
    {
        $shiftAttendances = ShiftAttendance::all();


        return view('administrator.shift-attendance.index', compact('shiftAttendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $locations = Location::get();
        return view('administrator.shift-attendance.create', compact('users', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shiftAttendance = $request->validate([
            'name_shift' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'user_id' => 'required',
        
        ]);

        ShiftAttendance::create($shiftAttendance);

        Alert::success('Success', 'Berhasil Menambahkan Data');
        return redirect()->route('index.shift-attendance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shiftAttendance = ShiftAttendance::find($id);

        return view('administrator.shift-attendance.show', ([
            'shiftAttendance' => $shiftAttendance
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $shiftAttendance = ShiftAttendance::find($id);
        $users = User::all();
        return view('administrator.shift-attendance.edit', ([
            'shiftAttendance' => $shiftAttendance,
            'users' => $users
        ]));
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
        $shiftAttendance = ShiftAttendance::find($id);

        $request->validate([
            'name_shift' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            
        ]);

      

        $shiftAttendance->update([
            'name_shift' => $request->name_shift,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        
        ]);

        dd($shiftAttendance);

        Alert::success('Info', 'Data Berhasil di update!');

        return redirect()->route('index.shift-attendance');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shiftAttendance = ShiftAttendance::find($id);

        $shiftAttendance->delete();
        Alert::success('Success', 'Berhasil Menghapus Data');

        return back();
    }
}

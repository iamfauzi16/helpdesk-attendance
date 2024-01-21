<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use App\Attendance;
use App\ShiftAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(['admin']);
    // }
    public function index()
    {
        $attendances = Attendance::all();

        return view('administrator.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $shiftAttendances = ShiftAttendance::all();
        return view('administrator.attendance.create',[
        'users' => $users,
        'shiftAttendances' => $shiftAttendances
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendance = $request->validate([
            'user_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
            'datetime' => 'required',
            'shift_attendance_id' => 'required'
        ]);


        Attendance::create($attendance);

        Alert::success('success', 'data berhasil ditambahkan');

        return redirect()->route('administrator.index.attendance');
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
        $attendance = Attendance::find($id);

        return view('administrator.attendance.edit', [
            'attendance' => $attendance
        ]);
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
        $attendance = $request->validate([
            'user_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
            'datetime' => 'required',
            'shift_attendance_id' => 'required'
        ]);


        Attendance::update($attendance);

        Alert::success('success', 'data berhasil diupdate');

        return redirect()->route('administrator.index.attendance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        $attendance->delete();

        Alert::success('Success', 'Berhasil Menghapus Data');
        return back();
    }
}

<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use App\EmployeeSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('admin');
    }
    public function index()
    {
        $employeeSchedules = EmployeeSchedule::orderBy('date', 'ASC')->get();
        $employeeScheduleGroups = $employeeSchedules->groupBy('user.name');
        
        return view('administrator.employee-attendance.index', [
            'employeeScheduleGroups' => $employeeScheduleGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('administrator.employee-attendance.create', [
            'users' => $users
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
        $request->validate([
            'date' => 'required',
            'status' => 'required',
            'user_id' => 'required'
        ]);

        EmployeeSchedule::create([
            'date' => $request->date,
            'status' => $request->status,
            'user_id' => $request->user_id
        ]);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('index.employee-schedule');
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

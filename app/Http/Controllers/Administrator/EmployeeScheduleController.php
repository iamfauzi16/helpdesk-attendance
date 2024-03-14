<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use App\ShiftAttendance;
use App\EmployeeSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        // $employeeSchedules = EmployeeSchedule::orderBy('date', 'ASC')->whereMonth('date', '2')->get();
        // $employeeScheduleGroups = $employeeSchedules->groupBy('user.name');
       
        $shiftAttendances = ShiftAttendance::all();
        $users = User::all();
        $calendars = [];

        $employeeSchedules = EmployeeSchedule::all();

        foreach($employeeSchedules as $employeeSchedule) {
            $userHoliday = $employeeSchedule->status;

            switch ($userHoliday) {
                case 'Masuk':
                    $calendars[] = [
                        'title' => $employeeSchedule->user->name,
                        'description' => $employeeSchedule->user->name . ' ('. $employeeSchedule->shift_name. ')',
    
                        'start' => $employeeSchedule->date,
                        'color' => 'Blue'
                    ];
                break;
                
                case 'Ijin':
                    $calendars[] = [
                        'title' => $employeeSchedule->user->name,
                        'description' => $employeeSchedule->user->name . ' ('. $employeeSchedule->shift_name. ')',
    
                        'start' => $employeeSchedule->date,
                        'color' => 'Orange'
                    ];
                break;

                case 'Cuti':
                    $calendars[] = [
                        'title' => $employeeSchedule->user->name,
                        'description' => $employeeSchedule->user->name . ' ('. $employeeSchedule->shift_name. ')',
    
                        'start' => $employeeSchedule->date,
                        'color' => 'Black'
                    ];
                break;
                
                default:
                    $calendars[] = [
                        'title' => $employeeSchedule->user->name,

                        'description' => $employeeSchedule->user->name . ' ('. $employeeSchedule->shift_name.')',
                        'start' => $employeeSchedule->date,
                        'color' => 'Green'
                    ];
                break;
            }           
        }

        return view('administrator.employee-attendance.index', [
            'shiftAttendances' => $shiftAttendances,
            'users' => $users,
            'calendars' => $calendars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shiftAttendances = ShiftAttendance::all();
        $users = User::all();
        $employeeSchedules = EmployeeSchedule::orderBy('date', 'ASC')->get();

        return view('administrator.employee-attendance.create', [
            'shiftAttendances' => $shiftAttendances,
            'users' => $users,
            'employeeSchedules' => $employeeSchedules
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
        'user_id' => 'required',
        'shift_name' => 'nullable'
    ]);

    EmployeeSchedule::create([
        'date' => $request->date,
        'status' => $request->status,
        'user_id' => $request->user_id,
        'shift_name' => $request->shift_name ?? 'Off' // Menggunakan null coalescing operator untuk menetapkan default value 'Off' jika shift_name kosong
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
        $employeeSchedule = EmployeeSchedule::find($id);

        $employeeSchedule->delete();

        Alert::info('Info', 'Data berhasil dihapus!');
        return back();
    }

    public function destroyAll()
    {
        EmployeeSchedule::truncate();

        Alert::info('Info', 'Data berhasil dihapus!');
        return back();
    }
}

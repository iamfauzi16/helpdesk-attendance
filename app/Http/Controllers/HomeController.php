<?php

namespace App\Http\Controllers;

use App\User;
use App\Attendance;
use App\ShiftAttendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     Auth()->user()->id;
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shiftAttendances = ShiftAttendance::all();
        $attendances = Attendance::orderBy('check_in', 'asc')->get();
        $users = User::all();
        return view('home', [
            'shiftAttendance' => $shiftAttendances,
            'user' => $users,
            'attendances' => $attendances
        ]);
    }
}

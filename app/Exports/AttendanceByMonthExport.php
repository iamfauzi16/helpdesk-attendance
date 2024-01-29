<?php

namespace App\Exports;

use App\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceByMonthExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
 

    public function view(): View
    {
        $user_id = auth()->user()->id;
        return view('attendance.excel', [
            'attendances' => Attendance::where('user_id', $user_id)->get()
        ]);
    }
}

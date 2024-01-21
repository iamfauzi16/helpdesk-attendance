<?php

namespace App\Exports;

use App\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('attendance.excel', [
            'attendances' => Attendance::all()
        ]);
    }
}

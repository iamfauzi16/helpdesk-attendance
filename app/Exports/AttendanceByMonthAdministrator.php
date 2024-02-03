<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceByMonthAdministrator implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $attendanceReport;

    public function __construct($attendanceReport)
    {
        $this->attendanceReport = $attendanceReport;
    }

    public function view(): View
    {
        return view('attendance.excel', [
            'attendances' => $this->attendanceReport
        ]);
    }
}

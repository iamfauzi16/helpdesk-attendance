<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceByMonthExport;
use App\Location;
use Carbon\Carbon;
use App\Attendance;
use App\ShiftAttendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function export_excel()
    {
        $user = Auth()->user()->name;

        return Excel::download(new AttendanceExport, now() . "_" . $user . ".xlsx");
    }

    public function export_byMonthExcel(Request $request)
    {
       // Assuming you have a 'selectMonth' input field in your request
    $selectMonth = $request->input('selectMonth');
    $year = now()->year; // You can modify this based on your requirement

    $startDate = now()->setYear($year)->month($selectMonth)->startOfMonth();
    $endDate = now()->setYear($year)->month($selectMonth)->endOfMonth();

    $attendanceReport = Attendance::whereBetween('datetime', [$startDate, $endDate])
        ->where('user_id', auth()->user()->id)
        ->get();

    return Excel::download(new AttendanceByMonthExport($attendanceReport), 'attendance_by_month.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        

    }


    public function index()
    {

        $user_id = Auth()->user()->id;

        $attendances = Attendance::where('user_id', $user_id)->get();

        $shiftAttendance = ShiftAttendance::where('user_id', $user_id)->first();


        if (!$shiftAttendance) {
            Alert::info('info', 'Kamu Belum diberikan Jadwal Shift');
            return back();
        }

        return view('attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function create()
    {
        return view('attendance.checkin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth()->user()->id;

        $checkin = Carbon::now();
        $datetime = $checkin->format('Y-m-d');

        // $location = Location::first();

        // $latitude = "-6.179467592090026";
        // $longitude = "106.81946867053011 ";

        // if($location->longitude == $longitude && $location->latitude == $latitude ) {
        //     Alert::info('Info', 'Kamu tidak berada dilokasi');

        //     return back();
        // }

        $shiftAttendance = ShiftAttendance::where('user_id', $user_id)
            ->first();

        if (!$shiftAttendance) {
            Alert::info('Info', 'Kamu Belum diberikan Jadwal Shift');

            return back();
        }


        $existAttendance = Attendance::where('user_id', $user_id)->where('datetime', $datetime)
            ->first();


        if ($existAttendance) {
            Alert::info('Info', 'Kamu Sudah Melakukan Absen');

            return back();
        }

        

        if (($shiftAttendance->name_shift == 'Shift Pagi' || $shiftAttendance->name_shift == 'Shift Sore') &&
            strtotime($checkin) >= strtotime($shiftAttendance->start_time)
        ) {

            $shiftStartTime = Carbon::parse($shiftAttendance->start_time);
            $checkinTime = Carbon::parse($checkin);
            $lateThreshold = $shiftStartTime->addMinutes(30);

            $attendanceData = [
                'check_in' => $checkin,
                'datetime' => $datetime,
                'user_id' => $user_id,
                'shift_attendance_id' => $shiftAttendance->id
            ];

            if ($checkinTime->greaterThan($lateThreshold)) {
                $attendanceData['status'] = 'Terlambat';
                $message = 'Terlambat lebih dari 30 menit.';
            } else {
                $attendanceData['status'] = 'Masuk';
                $message = 'Kamu berhasil Absen Hari Ini.';
            }

            $attendance = Attendance::create($attendanceData);
            $attendance->save();

            Alert::success('Success', $message);

            return redirect()->route('edit.attendance', $attendance->id);
        } else {

            Alert::info('Info', 'Kamu tidak dapat absen pada shift ini.');

            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        return view('attendance.checkout', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $user_id = auth()->user()->id;

        $shiftAttendance = ShiftAttendance::where('user_id', $user_id)->first();
        $checkout = Carbon::now()->format('H:i:s');
        $datetime = Carbon::now()->format('Y-m-d');

        if (!$shiftAttendance) {
            Alert::info('Info', 'Kamu Belum diberikan Jadwal Shift');

            return back();
        }

        if($attendance->checkout){
            Alert::info('Info', 'Kamu sudah melakukan absen keluar');
            return back();
        }

        // if(!$attendance->checkout) {
        //     if($checkout == $shiftAttendance->end_time)
        //     {
        //         $attendance->update([
        //             'check_out' => $checkout,
        //             'datetime' => $datetime
        //         ]);

        //         return 

        //     }
        // }
      
        $attendance->update([
            'check_out' => $checkout,
            'datetime' => $datetime
        ]);
        
        Alert::success('Success', 'Kamu Berhasil Absen Keluar');
        return redirect()->route('index.attendance');
        
    }
}

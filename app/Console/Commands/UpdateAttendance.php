<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Attendance; // Sesuaikan dengan model Attendance yang sesuai
use App\Models\ShiftAttendance; // Sesuaikan dengan model ShiftAttendance yang sesuai
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth; // Import Facade Auth

class UpdateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update attendance records';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $checkout = Carbon::now()->format('H:i:s');
     
        
        // Perubahan query untuk mencari catatan kehadiran yang sesuai
        $attendances = Attendance::get();
        
        foreach ($attendances as $attendance) {
            if ($attendance->check_out) {
                $this->info('User has already checked out.');
                continue;
            }
        
            $attendance->update([
                'check_out' => $checkout,
            ]);
        
            $this->info('Attendance record updated successfully.');
        }
        
    }
}

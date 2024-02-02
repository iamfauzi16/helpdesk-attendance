<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Attendance;
use App\ShiftAttendance;

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
        
        $users = User::all();

        foreach ($users as $user) {
          
            $shiftAttendance = ShiftAttendance::where('user_id', $user->id)->first();

            if (!$shiftAttendance) {
                $this->info("Shift user tidak diketemukan: {$user->id}");
                continue;
            }

            
            $attendances = Attendance::where('user_id', $user->id)->whereNull('check_out')->get();

            foreach ($attendances as $attendance) {
              
                if ($attendance->check_out) {
                    $this->info('User sudah melakukan absen keluar');
                    continue;
                }

                $attendance->update([
                    'check_out' => $shiftAttendance->end_time
                ]);

                $this->info('Absen keluar berhasil di update melalui scheduller.');
            }
        }
    }
}

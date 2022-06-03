<?php

namespace App\Console\Commands;

use App\Models\AppointmentSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateStatusAppointmentSchedele extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateAppointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for update status appointment schedule';

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
        $timeYesterDay      = Carbon::now('Asia/Ho_Chi_Minh')->addDay(-1)->endOfDay()->timestamp;
        $appointmentInvalid = DB::table('tbl_appointment_schedule')->select('*')
            ->where('date', '<=', $timeYesterDay)
            ->whereIn('status', [AppointmentSchedule::IS_PENDING, AppointmentSchedule::IS_ACTIVE, AppointmentSchedule::IS_CUTTING])
            ->get();
        foreach ($appointmentInvalid as $value) {
            $this->updateStatus($value->id, AppointmentSchedule::IS_DESTROY);
        }
        echo 'update success';

    }

    private function updateStatus($id, $status)
    {
        DB::table('tbl_appointment_schedule')
            ->where('id', $id)
            ->update(['status' => $status]);
    }
}

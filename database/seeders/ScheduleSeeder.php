<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'name' => 'Ferry 600 DWT',
            'working_hours' => 8,
            'start_date' => '2018-03-01',
            'completion_date' => '2019-08-01',
            'user_id' => 1
        ]);
    }
}

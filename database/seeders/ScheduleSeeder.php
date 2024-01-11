<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'name' => 'Ferry 600 DWT',
            'working_hours' => 8,
            'start_date' => '2018-03-01',
            'completion_date' => '2019-08-01',
        ]);
    }
}

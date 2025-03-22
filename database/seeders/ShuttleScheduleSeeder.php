<?php

namespace Database\Seeders;

use App\Models\ShuttleSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShuttleScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $dropOffTimes = ['03:00', '04:30', '06:00', '07:30', '09:00', '10:30', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00', '00:00'];
    $pickUpTimes = ['13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '00:00'];

    foreach ($dropOffTimes as $time) {
        ShuttleSchedule::create([
            'type' => 'drop_off',
            'time' => $time
        ]);
    }

    foreach ($pickUpTimes as $time) {
        ShuttleSchedule::create([
            'type' => 'pick_up',
            'time' => $time
        ]);
    }
}
}

<?php

use Illuminate\Database\Seeder;

class EventFixtures extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['event_title'=>'Daxx meeting', 'event_start_date'=>'2018-02-26', 'event_end_date' => '2018-02-26'],
            ['event_title'=>'Project development', 'event_start_date'=>'2018-02-27', 'event_end_date' => '2018-03-01'],
            ['event_title'=>'Project presentation', 'event_start_date'=>'2018-03-01', 'event_end_date' => '2018-03-01'],
        ];
        \DB::table('events')->insert($data);
    }
}

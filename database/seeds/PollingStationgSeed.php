<?php

use Illuminate\Database\Seeder;

class PollingStationgSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $station = new \App\PollingStation([
            'name'=>'New Zongo',
            'description'=>'New zongo polling station',
            'constituency_id'=>1
        ]);
        $station->save();

        $station = new \App\PollingStation([
            'name'=>'Amamdya Mosque',
            'description'=>'Amamdya Mosque polling station',
            'constituency_id'=>1
        ]);
        $station->save();


         $station = new \App\PollingStation([
            'name'=>'United Basic School',
            'description'=>'United Basic School polling station',
            'constituency_id'=>1
        ]);
        $station->save();



    }
}

<?php

use Illuminate\Database\Seeder;

class ConstituencySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $contituency = new \App\Constituency([
            'name'=>"Sissala East",
            'description'=>"Sissala East Constituency"
        ]);
        $contituency->save();


        $contituency = new \App\Constituency([
            'name'=>"Sissala West",
            'description'=>"Sissala West Constituency"
        ]);
        $contituency->save();



    }
}

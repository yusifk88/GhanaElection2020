<?php

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::where('id',1)->delete();
        \App\User::create([
            'name'=>'RADFORDFM',
            'email'=>'polls@radford.com',
            'password' => Hash::make('radford_electionhouse/@2020')
        ]);

    }
}

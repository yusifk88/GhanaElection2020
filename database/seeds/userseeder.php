<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'MTv',
            'email'=>'polls@mtv.com',
            'password' => Hash::make('_MTv/@election2020')
        ]);


    }
}

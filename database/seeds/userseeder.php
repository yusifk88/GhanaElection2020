<?php

use Illuminate\Database\Seeder;

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
            'password' => bcrypt('_MTv/@election2020')
        ]);


    }
}

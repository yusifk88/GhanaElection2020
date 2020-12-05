<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(userseeder::class);
        $this->call(PartiesSeed::class);
        $this->call(PresidentialCandidateSeed::class);
       // $this->call(ConstituencySeed::class);
        //$this->call(ParliamentryCandidateSeed::class);
        //$this->call(PollingStationgSeed::class);

    }
}

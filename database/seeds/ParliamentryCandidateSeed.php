<?php

use Illuminate\Database\Seeder;

class ParliamentryCandidateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $candidate = new \App\ParliamentryCandidate([
//            'name'=>'Amidu Chinnia Issahaku',
//            'party_id'=>1,
//            'constituency_id'=>1,
//            'photo'=>'/img/palcandidate/Amidu-Chinnia-Issahaku.jpg'
//        ]);
//        $candidate->save();
//
//
//
//        $candidate = new \App\ParliamentryCandidate([
//            'name'=>'Mohammed Issah Bataglia',
//            'party_id'=>2,
//            'constituency_id'=>1,
//            'photo'=>'/img/palcandidate/Mohammed-Issah-Bataglia.jpg'
//        ]);
//        $candidate->save();
//
//
//
//        $candidate = new \App\ParliamentryCandidate([
//            'name'=>'Zakaria Abdul-Baari Jaasu',
//            'party_id'=>6,
//            'constituency_id'=>1,
//            'photo'=>'/img/palcandidate/Zakaria-Abdul-Baari-Jaasu.jpg'
//        ]);
//        $candidate->save();
//
        $candidate = new \App\ParliamentryCandidate([
            'name'=>'Kingsley Kanton',
            'party_id'=>9,
            'constituency_id'=>1,
            'photo'=>'/img/palcandidate/Kingsley-Kanton.jpeg'
        ]);
        $candidate->save();






    }
}

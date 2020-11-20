<?php

use Illuminate\Database\Seeder;

class PresidentialCandidateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidate = new \App\PresidentialCandidate([
            'name'=>'Nana Addo Dankwa Akufo-Addo',
            'photo'=>'/public/img/pcandidate/Nana-Adda.png',
            'party_id'=>1
        ]);
        $candidate->save();


          $candidate = new \App\PresidentialCandidate([
            'name'=>'John Dramani Mahama',
              'photo'=>'/public/img/pcandidate/John-Mahama.jpg',
              'party_id'=>2
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Christian Kwabena Andrews',
              'photo'=>'/public/img/pcandidate/Christian-Kwabena-Andrews.jpg',
              'party_id'=>3
        ]);
        $candidate->save();

        $candidate = new \App\PresidentialCandidate([
            'name'=>'Ivor Kobina Greenstreet',
              'photo'=>'/public/img/pcandidate/Ivor-Kobina-Greenstreet.jpg',
              'party_id'=>4
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Akua Donkor',
              'photo'=>'/public/img/pcandidate/Akua-Donkor.jpg',
              'party_id'=>5
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Henry Herbert Lartey',
              'photo'=>'/public/img/pcandidate/Henry-Herbert-Lartey.jpg',
              'party_id'=>6
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Hassan Ayariga',
              'photo'=>'/public/img/pcandidate/Hassan-Ayariga.jpg',
              'party_id'=>7
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Kofi Akpaloo',
              'photo'=>'/public/img/pcandidate/Kofi-Akpaloo.jpg',
              'party_id'=>8
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'David Apasera',
            'photo'=>'/public/img/pcandidate/David-Apasera.jpg',
            'party_id'=>9
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Brigitte Dzogbenuku',
            'photo'=>'/public/img/pcandidate/Brigitte-Dzogbenuku.jpg',
            'party_id'=>10
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Nana Konadu Agyeman-Rawlings',
            'photo'=>'/public/img/pcandidate/Nana-Konadu-Agyeman-Rawlings.jpg',
            'party_id'=>11
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Asiedu Walker',
            'photo'=>'/public/img/pcandidate/Asiedu-Walker.jpg',
            'party_id'=>12
        ]);
        $candidate->save();



    }
}

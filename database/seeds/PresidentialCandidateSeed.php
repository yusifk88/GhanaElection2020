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
            'photo'=>'/img/pcandidate/Nana-Addo.png',
            'party_id'=>1
        ]);
        $candidate->save();


          $candidate = new \App\PresidentialCandidate([
            'name'=>'John Dramani Mahama',
              'photo'=>'/img/pcandidate/John-Mahama.jpg',
              'party_id'=>2
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Christian Kwabena Andrews',
              'photo'=>'/img/pcandidate/Christian-Kwabena-Andrews.jpg',
              'party_id'=>3
        ]);
        $candidate->save();

        $candidate = new \App\PresidentialCandidate([
            'name'=>'Ivor Kobina Greenstreet',
              'photo'=>'/img/pcandidate/Ivor-Kobina-Greenstreet.jpg',
              'party_id'=>4
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Akua Donkor',
              'photo'=>'/img/pcandidate/Akua-Donkor.jpg',
              'party_id'=>5
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Henry Herbert Lartey',
              'photo'=>'/img/pcandidate/Henry-Herbert-Lartey.jpeg',
              'party_id'=>6
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Hassan Ayariga',
              'photo'=>'/img/pcandidate/Hassan-Ayariga.jpg',
              'party_id'=>7
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Kofi Akpaloo',
              'photo'=>'/img/pcandidate/Kofi-Akpaloo.jpg',
              'party_id'=>8
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'David Apasera',
            'photo'=>'/img/pcandidate/David-Apasera.jpg',
            'party_id'=>9
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Brigitte Dzogbenuku',
            'photo'=>'/img/pcandidate/Brigitte-Dzogbenuku.jpg',
            'party_id'=>10
        ]);
        $candidate->save();



        $candidate = new \App\PresidentialCandidate([
            'name'=>'Nana Konadu Agyeman-Rawlings',
            'photo'=>'/img/pcandidate/Nana-Konadu-Agyeman-Rawlings.jpg',
            'party_id'=>11
        ]);
        $candidate->save();


        $candidate = new \App\PresidentialCandidate([
            'name'=>'Asiedu Walker',
            'photo'=>'/img/pcandidate/Asiedu-Walker.jpg',
            'party_id'=>12
        ]);
        $candidate->save();



    }
}

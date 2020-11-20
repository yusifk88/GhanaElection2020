<?php

use Illuminate\Database\Seeder;

class PartiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $party = new \App\Party([
            'name'=>'New Patriotic Party',
            'acronym'=>'NPP',
            'color'=>'#010199',
            'symbol_url'=>'/public/img/npp.gif'
        ]);
        $party->save();


          $party = new \App\Party([
            'name'=>'National Democratic Congress',
            'acronym'=>'NDC',
            'color'=>'#069240',
            'symbol_url'=>'/public/img/ndc.jpg'
        ]);
        $party->save();



          $party = new \App\Party([
            'name'=>'Ghana Union Movement',
            'acronym'=>'GUM',
            'color'=>'#8D0420',
            'symbol_url'=>'/public/img/gum.png'
        ]);
        $party->save();


        $party = new \App\Party([
            'name'=>"Convention People’s Party",
            'acronym'=>'CPP',
            'color'=>'#D31F14',
            'symbol_url'=>'/public/img/cpp.jpg'
        ]);
        $party->save();


        $party = new \App\Party([
            'name'=>"Ghana Freedom Party",
            'acronym'=>'GFP',
            'color'=>'#e1e510',
            'symbol_url'=>'/public/img/symbol.png'
        ]);
        $party->save();


        $party = new \App\Party([
            'name'=>"Great Consolidated Popular Party",
            'acronym'=>'GCPP',
            'color'=>'#F63B7B',
            'symbol_url'=>'/public/img/gcpp.jpg'
        ]);
        $party->save();



        $party = new \App\Party([
            'name'=>"All People’s Congress",
            'acronym'=>'APC',
            'color'=>'#F9CD0E',
            'symbol_url'=>'/public/img/apc.jpg'
        ]);
        $party->save();




        $party = new \App\Party([
            'name'=>"Liberal Party of Ghana",
            'acronym'=>'LPG',
            'color'=>'#6FC8FF',
            'symbol_url'=>'/public/img/symbol.png'
        ]);
        $party->save();





        $party = new \App\Party([
            'name'=>"People’s National Convention",
            'acronym'=>'PNC',
            'color'=>'#519D78',
            'symbol_url'=>'/public/img/pnc.jpg'
        ]);
        $party->save();




        $party = new \App\Party([
            'name'=>"Progressive People’s Party",
            'acronym'=>'PPP',
            'color'=>'#ED3338',
            'symbol_url'=>'/public/img/ppp.jpg'
        ]);
        $party->save();




        $party = new \App\Party([
            'name'=>"National Democratic Party",
            'acronym'=>'NDP',
            'color'=>'#160103',
            'symbol_url'=>'/public/img/ndp.png'
        ]);
        $party->save();



        $party = new \App\Party([
            'name'=>"Independent",
            'acronym'=>'INDEPENDENT',
            'color'=>'#ccbe43',
            'symbol_url'=>'/public/img/symbol.png'
        ]);
        $party->save();



    }
}

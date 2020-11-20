<?php

namespace App\Observers;

use App\ParliamentryCandidate;
use App\PollingStation;
use App\PresidentialCandidate;
use App\Vote;

class VoteObserver
{
    public function retrieved(Vote $vote){

       $vote->candidate =  $vote->type === 'MP' ?  ParliamentryCandidate::find($vote->candidate_id) : PresidentialCandidate::find($vote->candidate_id);
        $vote->polling_station = PollingStation::find($vote->polling_station_id);

    }
}

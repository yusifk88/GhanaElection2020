<?php

namespace App\Http\Controllers;

use App\Constituency;
use App\ParliamentryCandidate;
use App\Party;
use App\PollingStation;
use App\PresidentialCandidate;
use App\Vote;
use Illuminate\Http\Request;

class PartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::all();

        foreach($parties as $party){
            $party->votes = Vote::whereIn('candidate_id',PresidentialCandidate::select('id')->where('party_id',$party->id))->where('type','President')->sum('votes');

            $party->candidate = PresidentialCandidate::where('party_id',$party->id)->get()->first();
        }

        return response()->json($parties);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = PresidentialCandidate::find($id);
        $candidate->party = Party::find($candidate->party_id);
        $all_votes= Vote::where('type','President')->sum('votes');

        $constiteuncies = Constituency::all();
        $consttit = [];

        foreach ($constiteuncies as $constiteuncy){

            $polling_stations =  PollingStation::where('constituency_id',$constiteuncy->id)->orderBy('name','asc')->get();

            foreach ($polling_stations as $polling_station){

                    $polling_station->votes = Vote::where('polling_station_id',$polling_station->id)->where('candidate_id',$id)->where('type','President')->sum('votes');
                $polling_station->no_votes = Vote::where('polling_station_id',$polling_station->id)->where('candidate_id','<>',$id)->where('type','President')->sum('votes');

            }

            $constiteuncy->polling_stations = $polling_stations;

            array_push($consttit,$constiteuncy);

        }
        $candidate->all_votes = $all_votes;


        $data['candidate'] = $candidate;
        $data['constituencies'] =$consttit;

        return response()->json($data);



    }


    public function showparl($id)
    {
        $candidate = ParliamentryCandidate::find($id);
        $candidate->party = Party::find($candidate->party_id);
        $all_votes= Vote::where('type','MP')->whereIn('candidate_id',ParliamentryCandidate::select('id')->where('constituency_id',$candidate->constituency_id))->sum('votes');
        $rejected_votes= Vote::where('type','MP')->whereIn('candidate_id',ParliamentryCandidate::select('id')->where('constituency_id',$candidate->constituency_id))->sum('rejected');

        $constiteuncy = Constituency::find($candidate->constituency_id);
        $stations = [];


            $polling_stations =  PollingStation::where('constituency_id',$constiteuncy->id)->orderBy('name','asc')->get();

            foreach ($polling_stations as $polling_station){

                    $polling_station->votes = Vote::where('polling_station_id',$polling_station->id)->where('candidate_id',$id)->where('type','MP')->sum('votes');
                    $polling_station->no_votes = Vote::where('polling_station_id',$polling_station->id)->where('candidate_id','<>',$id)->where('type','MP')->sum('votes');

                array_push($stations,$polling_station);
            }


        $candidate->valid_votes = $all_votes;
        $candidate->rejected_votes = $rejected_votes;
        $candidate->constituency = $constiteuncy;


        $data['candidate'] = $candidate;
        $data['polling_stations'] =$polling_stations;

        return response()->json($data);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function parlresults($constituency_id){


        $parties = Party::whereIn('id',ParliamentryCandidate::select('party_id')->where('constituency_id',$constituency_id))->get();

        foreach($parties as $party){
            $party->votes = Vote::whereIn('candidate_id',ParliamentryCandidate::select('id')->where('party_id',$party->id)->where('constituency_id',$constituency_id))->where('type','MP')->sum('votes');

            $party->candidate = ParliamentryCandidate::where('party_id',$party->id)->where('constituency_id',$constituency_id)->get()->first();
        }

        return response()->json($parties);



    }



}

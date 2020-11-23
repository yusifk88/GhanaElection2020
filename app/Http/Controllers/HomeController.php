<?php

namespace App\Http\Controllers;

use App\Constituency;
use App\Events\ResultsPublished;
use App\ParliamentryCandidate;
use App\Party;
use App\PollingStation;
use App\PresidentialCandidate;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (User::isAdmin()) {
            $total_vote = Vote::where('type', 'President')->sum('votes');
            $total_votep = Vote::where('type', 'MP')->sum('votes');
            $rejected_vote = Vote::where('type', 'President')->sum('rejected');
            $rejected_votep = Vote::where('type', 'MP')->sum('rejected');
        }else{

            $total_vote = Vote::whereIn('polling_station_id',  PollingStation::select('id')->where('constituency_id',auth()->user()->constituency_id))->where('type', 'President')->sum('votes');
            $rejected_vote = Vote::whereIn('polling_station_id',  PollingStation::select('id')->where('constituency_id',auth()->user()->constituency_id))->where('type', 'President')->sum('rejected');
            $total_votep = Vote::whereIn('polling_station_id',  PollingStation::select('id')->where('constituency_id',auth()->user()->constituency_id))->where('type', 'MP')->sum('votes');
            $rejected_votep = Vote::whereIn('polling_station_id',  PollingStation::select('id')->where('constituency_id',auth()->user()->constituency_id))->where('type', 'MP')->sum('rejected');

        }

        $parties = Party::all();
        $data['press_candidates'] = PresidentialCandidate::all();
        if (User::isAdmin()){
        $data['constituencies'] = Constituency::all();
        }else{
            $data['constituencies'] = Constituency::where('id',auth()->user()->constituency_id)->get();

        }
        $data['parties'] = $parties;
        $data['votes']=$total_vote;
        $data['votesp']=$total_votep;
        $data['rejected_votes']=$rejected_vote;
        $data['rejected_votesp']=$rejected_votep;

        return view('home',$data);

    }



    public function recordparliamentary($id){
        $data['candidates'] = DB::select("select * from parliamentary_candidate where constituency_id = '$id' order by name ");
        $data['polling_stations'] = DB::select("select * from polling_stations where constituency_id = '$id' order by name ");
        $data['constituency'] = Constituency::find($id);
        $data['votes'] = Vote::whereIn('polling_station_id',PollingStation::select('id')->where('constituency_id',$id))->where('type','MP')->get();

        return view('recordparliamentary',$data);

    }

    public function recordpresidential($id){
        $data['candidates'] = DB::select("select * from presidential_candidate ");
        $data['polling_stations'] = DB::select("select * from polling_stations where constituency_id = '$id' order by name ");
        $data['constituency'] = Constituency::find($id);
        $data['votes'] = Vote::whereIn('polling_station_id',PollingStation::select('id')->where('constituency_id',$id))->where('type','President')->get();

        return view('recordpresidential',$data);

    }


    public function selectconstituency(){
        if (User::isAdmin()){
            $constitencies = Constituency::orderBy('name')->get();

        }else{

            $constitencies = Constituency::where('id',auth()->user()->constituency_id)->orderBy('name')->get();

        }


        return view('selectconstituency',['constituencies'=>$constitencies]);


    }

    public function selectconstituencypresidential(){

        if (User::isAdmin()){
            $constitencies = Constituency::orderBy('name')->get();

        }else{

            $constitencies = Constituency::where('id',auth()->user()->constituency_id)->orderBy('name')->get();

        }

        return view('selectconstituencypresidential',['constituencies'=>$constitencies]);


    }

    public function savempresults(Request $request){
        if (Vote::where('type',$request->type)->where('candidate_id',$request->candidate_id)->where('polling_station_id',$request->polling_station_id)->exists()){
            return redirect()->back()->with('error',"Results for this candidate at this polling station was entered");

        }

        $candidate = $request->type==='MP' ? ParliamentryCandidate::find($request->candidate_id) : PresidentialCandidate::find($request->candidate_id);

        $station = PollingStation::find($request->polling_station_id);

        $vote = new Vote([
            'candidate_id'=>$request->candidate_id,
            'polling_station_id'=>$request->polling_station_id,
            'votes'=>$request->result,
            'rejected'=>$request->rejected ?? 0 ,
            'type'=>$request->type
        ]);
        $vote->save();


        if ($vote){
            if ($request->type==='MP'){
            $data['type']='MP';
            $data['candidate_id']=$request->candidate_id;
            $data['constituency_id']=$station->constituency_id;
             broadcast(new ResultsPublished($data));
            }else{

                $data['type']='President';
                $data['candidate_id']=$request->candidate_id;
                $data['constituency_id']=$station->constituency_id;
                broadcast(new ResultsPublished($data));

            }

            return redirect()->back()->with('success',$request->result." votes recorded for ".$candidate->name." at ".$station->name);
        }else{
            return redirect()->back()->with('error',"Something went wrong could save results");
        }
    }


    public function deletevote($id){
        DB::statement("delete from votes where id = '$id'");
        return redirect()->back()->with('success','Vote deleted successfully');
    }




    public function home(){
        return view('home');

    }

    public static function partypresvotes($candidate_id){
        if (User::isAdmin()){

            $votes = Vote::where('candidate_id',$candidate_id)->where('type','President')->sum('votes');
        }else{

            $votes = Vote::where('candidate_id',$candidate_id)->where('type','President')->whereIn('polling_station_id',PollingStation::select('id')->where('constituency_id',auth()->user()->constituency_id))->sum('votes');


        }


        return $votes;

    }

    public static function partyparlvotes($candidate_id){

        $votes = Vote::where('candidate_id',$candidate_id)->where('type','MP')->sum('votes');

        return $votes;

    }


    public function createconstituency(){

    if (User::isAdmin()){

        return view('constituency.create');


    }

    }

    public function saveconstituency(Request $request){


            if (!Constituency::where('name',$request->name)->exists()){

                $constituency = new Constituency([
                    'name'=>$request->name,
                    'description'=>$request->description
                ]);
                $constituency->save();

                if ($constituency){

                    return redirect()->back()->with('success','Constituency saved');
                }else{
                    return redirect()->back()->with('error','Could not save constituency ');

                }


            }else{
                return redirect()->back()->with('error','Constituency with name '.$request->name." already exists");

            }

    }

    public function savepollingstation(Request $request){


            if (!PollingStation::where('name',$request->name)->where('constituency_id',$request->constituency_id)->exists()){

                $station = new PollingStation([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'constituency_id'=>$request->constituency_id
                ]);
                $station->save();

                if ($station){

                    return redirect()->back()->with('success','Polling station saved');
                }else{
                    return redirect()->back()->with('error','Could not save Polling station ');

                }


            }else{
                return redirect()->back()->with('error','Polling station with name '.$request->name." already exists in this constituency");



        }



    }

    public function createpollingstation(){

        if (User::isAdmin()){
            $data['constituencies'] = Constituency::orderBy('name')->get();

        }else{

            $data['constituencies'] = Constituency::where('id',auth()->user()->constituency_id)->orderBy('name')->get();

        }

            return view('pollingstation.create',$data);



    }

    public function createuser(){

        if (User::isAdmin()){
            $data['constituencies'] = Constituency::all();

            return view('auth.register',$data);
        }

    }



    public function saveuser(Request $request){

        if (User::isAdmin()){
            $data = $request->all();

            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'constituency_id'=>$data['constituency_id']
            ]);

            $user->save();
            if ($user){

                return redirect()->back()->with('success','New user created');
            }else{
                return redirect()->back()->with('error','Could not create user ');

            }


        }

    }


    public function createpaliarmentarycandidate(){

        if (User::isAdmin()){
        $constituencies = Constituency::all();
        }else{

            $constituencies = Constituency::where('id',auth()->user()->constituency_id)->get();

        }

        $data['parties'] = Party::all();
        $data['constituencies'] = $constituencies;

        return view('parliamentarycandidate.create',$data);


    }

    public function saveparliamentarycandidate(Request $request){


        $candidate = new ParliamentryCandidate([
            'name'=>$request->name,
            'constituency_id'=>$request->constituency_id,
            'party_id'=>$request->party_id,
            'photo'=> $request->hasFile('photo') ?  Storage::url($request->file('photo')->store('public/candidate')) : '/img/photo.png'
        ]);
        $candidate->save();

            return redirect()->back()->with('success',"Candidate ".$candidate->name." registered successfully");


    }




}

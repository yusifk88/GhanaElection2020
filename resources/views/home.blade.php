@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-muted">Presidential votes Summary</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-dark">{{number_format($votes+$rejected_votes,0)}}</h4>
                                <small class="text-muted">Total Votes Cast</small>
                        </div>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-danger">{{number_format($rejected_votes,0)}}</h4>
                                <small class="text-muted">Total Rejected Votes</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-success">{{number_format(($votes),0)}}</h4>
                                <small class="text-muted">Total Valid Votes</small>
                        </div>
                    </div>
                </div>

            </div>
            <h3 class="text-muted">Parliamentary votes Summary</h3>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-dark">{{number_format($votesp+$rejected_votesp,0)}}</h4>
                                <small class="text-muted">Total Votes Cast</small>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-danger">{{number_format($rejected_votesp,0)}}</h4>
                                <small class="text-muted">Total Rejected Votes</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-success">{{number_format(($votesp),0)}}</h4>
                                <small class="text-muted">Total Valid Votes</small>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row mt-5">
                <div class="col-md-12">
                    <h2 class="text-muted">Presidential Results</h2>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="list-group">
                                    <?php
                                        $total_votes = \App\Vote::where('type','President')->sum('votes')
                                    ?>
                                    @foreach($press_candidates as $candidate)


                                        <?php

                                            $party = \App\Party::find($candidate->party_id);
                                            $votes = \App\Http\Controllers\HomeController::partypresvotes($candidate->id);
                                            $percentage = $total_votes > 0 ? (($votes/$total_votes)*100) : 0;


                                        ?>
                                            <div class="list-group-item">


                                            <div class="row">
                                            <div class="col-md-2">
                                                <img class="img-circle img-fluid" src="{{$candidate->photo}}">

                                            </div>
                                            <div class="col-md-10">
                                                <h4>{{$candidate->name}}</h4>
                                                <small class="text-muted">{{$party->acronym}} | {{number_format($votes,2)}} votes({{(float) number_format($percentage,2)}}%)</small><br>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{(float) number_format($percentage,2)}}%; background-color: {{$party->color}}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{(float) number_format($percentage,2)}}%</div>
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                  @endforeach



                            </div>


                        </div>
                    </div>

                </div>

            </div>
            @foreach($constituencies as $constituency)

            <div class="row mt-5">
                <div class="col-md-12">
                    <h2 class="text-muted">Parliamentary  Results - {{$constituency->name}}</h2>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $total_votes = \App\Vote::where('type','MP')->sum('votes');
                            $parl_candidates = \App\ParliamentryCandidate::where('constituency_id',$constituency->id)->get();
                            ?>

                            @if(count($parl_candidates)>0)

                            @foreach($parl_candidates as $candidate)
                                <?php

                                $party = \App\Party::find($candidate->party_id);
                                    $votes = \App\Http\Controllers\HomeController::partyparlvotes($candidate->id);
                                $percentage = ($votes/$total_votes)*100;

                                ?>

                                <div class="row m-3">
                                    <div class="col-md-2">
                                        <img class="img-circle img-fluid" src="{{$candidate->photo}}">

                                    </div>
                                    <div class="col-md-10">
                                        <h4>{{$candidate->name}}</h4>
                                        <small class="text-muted">{{$party->acronym}} | {{number_format($votes,2)}} votes({{(float) number_format($percentage,2)}}%)</small><br>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{(float) number_format($percentage,2)}}%; background-color: {{$party->color}}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{(float) number_format($percentage,2)}}%</div>
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                               @else
                                <center>
                                    <h3 class="text-muted">No candidate found in this constituency.</h3>
                                </center>

                                @endif

                        </div>
                    </div>

                </div>

            </div>

        @endforeach

        </div>
    </div>
</div>
@endsection

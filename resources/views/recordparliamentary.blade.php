@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <h3>Publish parliamentary Results from {{$constituency->name}} constituency</h3>
                <div class="alert alert-warning">
                    <p><strong>NOTE:</strong>
                        Please be sure of the selected candidate, polling station and the value entered before clicking on the save button.</p>
                        <p>Anything you save here will be visible to the public immediately.</p>

                </div>

                <form method="post" action="{{route('SaveParliamentryResult')}}">
                    {{csrf_field()}}
                    <input value="MP" name="type" type="hidden">
                    <div class="row">
                        <div class="col-3">
                            <label for="candidate" class="form-control-label">Candidate</label>
                            <select id="candidate" required class="form-control" name="candidate_id">
                                <option></option>
                                @foreach($candidates as $candidate)
                                    <option value="{{$candidate->id}}">{{$candidate->name}}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <label class="form-control-label">Polling Station</label>
                            <select required class="form-control" name="polling_station_id">
                                <option></option>
                                @foreach($polling_stations as $station)
                                    <option value="{{$station->id}}">{{$station->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-3">
                            <label class="form-control-label">Results</label>
                            <input class="form-control" type="number" min="1" step="0" required name="result">
                        </div>
                        <div class="col-3">
                            <label class="form-control-label">Rejected Votes</label>
                            <input class="form-control" type="number" name="rejected">
                        </div>


                        <div class="col-4 p-3 ml-auto  align-content-end">
                          <button type="submit" class="btn btn-primary">Publish</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>

</div>

    <div class="row">
        <div class="col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4>Recorded Votes from {{$constituency->name}} constituency</h4>
                    @include('partials.votes')
                </div>

            </div>

        </div>

    </div>

@endsection

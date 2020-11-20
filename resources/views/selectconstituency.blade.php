@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h3>Select Constituency to publish parliamentary results</h3>
                <div class="row">
                    @foreach($constituencies as $constituency)
                        <div class="col-md-4">
                            <a class="btn btn-outline-primary btn-lg p-5" href="{{route('RecordParliamentary',$constituency->id)}}">{{$constituency->name}}</a>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

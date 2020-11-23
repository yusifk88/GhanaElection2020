@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Create a new polling station</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('savepollingstation')}}">
                        {{csrf_field()}}
                        <div class="col-md-12">
                            <label class="form-control-label">Constituency</label>
                            <select required class="form-control" name="constituency_id">
                                @foreach($constituencies as $constituency)
                                    <option value="{{$constituency->id}}">{{$constituency->name}}</option>
                                @endforeach

                            </select>
                        </div>


                        <div class="col-md-12">
                            <label class="form-control-label">Name</label>
                            <input required type="text" class="form-control" name="name">
                        </div>

                        <div class="col-md-12">
                            <label class="form-control-label">Description</label>
                            <textarea rows="3" class="form-control" name="description"></textarea>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
    <div class="row">
        @foreach($constituencies as $constituency)

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Polling stations - {{$constituency->name}}
                </div>
                <div class="card-body">
                    <?php
                        $polling_stations = \App\PollingStation::where('constituency_id',$constituency->id)->get();
                        $i=1;
                        ?>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($polling_stations as $station)

                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$station->name}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        @endforeach

    </div>


@endsection

<table class="table table-striped table-hover" id="table">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Polling Station</th>
            <th>Votes</th>
            <th>Rejected Votes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($votes as $vote)
            <tr>
                <td>

                    <img class="img-thumbnail" width="60px" src="{{$vote->candidate->photo}}">
                </td>
                <td>
                    {{$vote->candidate->name}}
                </td>
                <td>
                    {{$vote->polling_station->name}}
                </td>
                <td class="text-center"><strong class="text-success ">{{$vote->votes}}</strong></td>
                <td class="text-center"><strong class="text-muted text-center">{{$vote->rejected}}</strong></td>
                <td>
                    <a class="btn btn-link text-danger" href="{{route('DeleteVote',$vote->id)}}">Delete</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

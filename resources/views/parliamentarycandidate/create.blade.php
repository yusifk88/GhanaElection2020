@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Register a new parliamentary candidate</h4>
                </div>
                <div class="card-body">
                    <form method="POSt" action="{{route('saveparliamentarycandidate')}}" enctype="multipart/form-data">

                        {{csrf_field()}}
                        <div class="col-md-12">
                            <img id="image_preview" src="{{asset('/img/photo.png')}}" class="img-fluid img-thumbnail" width="160px">
                            <input onchange="setphoto()" type="file" accept="image/*" name="photo" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-control-label">Name</label>
                            <input class="form-control" name="name" required type="text" autocomplete="name" autofocus>
                        </div>

                        <div class="col-md-12">
                            <label class="form-control-label">Constituency</label>
                            <select class="form-control" name="constituency_id" required>
                                @foreach($constituencies as $constituency)
                                <option value="{{$constituency->id}}">{{$constituency->name}}</option>
                              @endforeach
                            </select>

                        </div>

                        <div class="col-md-12">
                            <label class="form-control-label">Party</label>
                            <select class="form-control" name="party_id" required>
                                @foreach($parties as $party)
                                <option value="{{$party->id}}">{{$party->name}}</option>
                              @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary mt-5">Save</button>

                        </div>

                    </form>
                </div>


            </div>
        </div>

    </div>

    <script>
        function setphoto() {

                let file = event.target.files[0];

                const fr = new FileReader();
            fr.readAsDataURL(file);

            fr.onload=function(){
                document.getElementById('image_preview').src = fr.result;


                    };


        }
    </script>
@endsection



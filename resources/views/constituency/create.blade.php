@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Create a new constituency</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('saveconstituency')}}">
                        {{csrf_field()}}
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
@endsection

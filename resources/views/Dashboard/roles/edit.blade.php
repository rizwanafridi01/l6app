@extends('Dashboard.layout');
@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Roles</h1>

    </div>
    <form action="{{ route('roles.update', $role->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputText">Role Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" id="inputText" aria-describedby="textHelp" placeholder="Enter Role">
                    {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

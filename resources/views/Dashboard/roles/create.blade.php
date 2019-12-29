@extends('Dashboard.layout');
@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Roles</h1>

    </div>
<form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputText">Role Name</label>
                <input type="text" name="name" class="form-control" id="inputText" aria-describedby="textHelp" placeholder="Enter Role">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
    @endsection

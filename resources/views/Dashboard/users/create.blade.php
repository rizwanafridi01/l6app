@extends('Dashboard.layout')
@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create User</h1>

    </div>
<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputText">Name</label>
                <input type="text" name="username" class="form-control" id="inputText" aria-describedby="textHelp" placeholder="Enter User Name">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputFullName">Full Name</label>
                <input type="text" name="name" class="form-control" id="inputFullName" aria-describedby="textHelp" placeholder="Enter Full Name">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputUserEmail">Email</label>
                <input type="text" name="email" class="form-control" id="inputUserEmail" aria-describedby="textHelp" placeholder="Enter a valid Email address">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" aria-describedby="textHelp" placeholder="Enter password">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputPhone">Phone</label>
                <input type="text" name="phone" class="form-control" id="inputPhone" aria-describedby="textHelp" placeholder="+123455678">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="selectCountry">Select Country</label>
                <select name="country" id="selectCountry" class="form-control">
{{--                    <option value="0">Parent Category</option>--}}
                    @if(!$countries->IsEmpty())
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputCity">City</label>
                <input type="text" name="city" class="form-control" id="inputCity" aria-describedby="textHelp" placeholder="Enter City">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="address" class="form-control" id="inputAddress" aria-describedby="textHelp" placeholder="Enter Address">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="selectRoles">Select Roles</label>
                <select name="roles[]" id="selectRoles" class="form-control" multiple>
{{--                    <option value="0">Parent Category</option>--}}
                    @if(!$roles->IsEmpty())
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label for="inputProfileImage">Profile Image</label>
                <input type="file" name="photo" class="form-control" id="inputProfileImage" aria-describedby="thumbnailHelp">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>


        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
    @endsection

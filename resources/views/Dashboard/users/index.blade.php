@extends('Dashboard.layout')
@section('content')



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('users.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Add New User</a>

            </div>
        </div>
    </div>


@if(!$users->IsEmpty())
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Name</th>
                <th>Thumbnail</th>
                <th>City</th>
                <th>Country</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
{{--                    <img src="{{url('storage/'.$user->thumbnail)}}" alt="">--}}


                        <td>@if($user->profile)<img src="{{url('storage/'.$user->profile->photo )}}" alt="" width="40px" height="40px">@else <p>N/A</p>@endif</td>
                        <td>{{ $user->profile->city ?? "N/A" }}</td>
                        <td>{{ $user->profile->country->name ?? "N/A"}}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        @if(!$user->roles->IsEmpty())

                            {{ $user->roles->implode('name',', ') }},

                         @else
                            <p>No role</p>
                        @endif
                    </td>

                    <td>


                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a role="button" href="{{ route('users.edit', $user->id) }}"  class="btn btn-link">edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                            <button type="submit" class="btn btn-link">Delete</button>
                            </form>
                            <a role="button" href="{{ route('users.show', $user->id) }}" class="btn btn-link">show</a>
                        </div>


                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @else

    <p class="alert alert-primary">No User Found</p>

@endif

@endsection

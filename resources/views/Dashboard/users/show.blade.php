@extends('Dashboard.layout')
@section('content')



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User show</h1>
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
                    <th>Roles</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $user->name }}</td>
                        {{--                    <img src="{{url('storage/'.$user->thumbnail)}}" alt="">--}}
                        <td><img src="{{url('storage/'.$user->profile->photo)}}" alt="" width="40px" height="40px"></td>
                        <td>{{ $user->profile->city }}</td>
                        <td>{{ $user->profile->country->name }}</td>
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

                            </div>


                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

    @else

        <p class="alert alert-primary">No User Found</p>

    @endif

@endsection

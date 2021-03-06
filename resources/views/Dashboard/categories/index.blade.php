@extends('Dashboard.layout')
@section('content')



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Roles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Add New Role</a>

            </div>
        </div>
    </div>


@if(!$categories->IsEmpty())
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>title</th>
                <th>Thumbnail</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Children</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
{{--                    <img src="{{url('storage/'.$category->thumbnail)}}" alt="">--}}
                    <td><img src="{{url('storage/'.$category->thumbnail)}}" alt="" width="40px" height="40px"></td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        @if(!$category->children->IsEmpty())
                        @foreach($category->children as $child)
                            {{ $child->title }},
                            @endforeach
                         @else
                            <p>parent category</p>
                        @endif
                    </td>

                    <td>


                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a role="button" href="{{ route('categories.edit', $category->id) }}"  class="btn btn-link">edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                            <button type="submit" class="btn btn-link">Delete</button>
                            </form>
                            <a role="button" href="{{ route('categories.show', $category->id) }}" class="btn btn-link">show</a>
                        </div>


                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @else

    <p class="alert alert-primary">No Category Found</p>

@endif

@endsection

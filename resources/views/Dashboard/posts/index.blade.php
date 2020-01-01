@extends('Dashboard.layout')
@section('content')



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">posts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('posts.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Add New post</a>

            </div>
        </div>
    </div>


@if(!$posts->IsEmpty())
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>title</th>
                <th>Thumbnail</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Categories</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
{{--                    <img src="{{url('storage/'.$post->thumbnail)}}" alt="">--}}
                    <td><img src="{{url('storage/'.$post->thumbnail)}}" alt="" width="40px" height="40px"></td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        @if(!$post->categories->IsEmpty())
                        @foreach($post->categories as $cat)
                            {{ $cat->title }},
                            @endforeach
                         @else
                            <p>No category</p>
                        @endif
                    </td>

                    <td>


                        <div class="btn-group" role="group" aria-label="Basic example">
                            @can('isAdmin')
                            <a role="button" href="{{ route('posts.edit', $post->id) }}"  class="btn btn-link">edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                            <button type="submit" class="btn btn-link">Delete</button>
                            </form>
                            @endcan
                            <a role="button" href="{{ route('posts.show', $post->id) }}" class="btn btn-link">show</a>
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

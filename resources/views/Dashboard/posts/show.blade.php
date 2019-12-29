@extends('Dashboard.layout');
@section('content')



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Show Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('posts.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Add New Post</a>

            </div>
        </div>
    </div>


    @if(isset($post))
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

                    <tr>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{url('storage/'.$post->thumbnail)}}" alt="" width="40px" height="40px"></td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>

                        <td>
                            @foreach($post->categories as $cat)
                                {{ $cat->title }}
                            @endforeach
                        </td>

                        <td>


                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a role="button" href="{{ route('posts.edit', $post->id) }}"  class="btn btn-link">edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
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

        <p class="alert alert-primary">No Category Found</p>

    @endif

@endsection

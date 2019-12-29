@extends('Dashboard.layout')
@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>

    </div>
    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputText">title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="inputText" aria-describedby="textHelp" placeholder="Enter title">
                    {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputText">Content</label>
                    <textarea  name="description" class="form-control" id="inputContent" aria-describedby="contentHelp" >{!! $post->content !!}</textarea>
                    {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputText">file</label>
                    <input type="file" name="thumbnail"  class="form-control" value="{{$post->thumbnail}}" id="inputthumbnail" aria-describedby="thumbnailHelp">
                    {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
                    <img src="{{url('storage/'.$post->thumbnail)}}" alt="" width="40px" height="40px">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select name="categories[]" id="" multiple>
{{--                        <option value="0">Category</option>--}}
                        @if(!$categories->IsEmpty())
                            @foreach($categories as $cat)
                                <option
                                    @if(in_array($cat->id,
                                    $post->categories->pluck('id')->toArray()))
                                    {{'selected'}}
                                    @endif
                                    value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

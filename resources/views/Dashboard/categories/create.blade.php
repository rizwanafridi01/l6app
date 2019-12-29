@extends('Dashboard.layout')
@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Category</h1>

    </div>
<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputText">title</label>
                <input type="text" name="title" class="form-control" id="inputText" aria-describedby="textHelp" placeholder="Enter title">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="inputText">Content</label>
                <textarea  name="description" class="form-control" id="inputContent" aria-describedby="contentHelp" ></textarea>
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>



        <div class="col-md-12">
            <div class="form-group">
                <label for="inputText">file</label>
                <input type="file" name="thumbnail" class="form-control" id="inputthumbnail" aria-describedby="thumbnailHelp">
                {{--        <small id="emailHelp" class="form-text text-muted">Enter role name</small>--}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <select name="parent_id" id="">
                    <option value="0">Parent Category</option>
                    @if(!$parent_cat->IsEmpty())
                        @foreach($parent_cat as $cat)
                        <option value="{{ $cat->parent_id }}">{{ $cat->title }}</option>
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

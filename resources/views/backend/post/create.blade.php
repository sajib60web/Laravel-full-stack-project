@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 border-bottom text-center">Create Post</h3>
        <div class="col-md-8 offset-md-2 card">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Post Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Content</label>
                    <textarea name="post_content" class="form-control" placeholder="Enter Content"></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Thumbnail</label>
                    <input type="file" name="thumbnail_path" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-md-right">Submit</button>
            </form>
        </div>
        <p class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-success">Back to Post List</a>
        </p>
    </div><!-- /.blog-main -->
@stop

@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 border-bottom text-center">Create Category</h3>
        <div class="col-md-8 offset-md-2 card">
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
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
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" placeholder="Enter Slug">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="status{{$category->status}}">
                        <option>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <script>
                    document.getElementById('status{{$category->status}}').value = {{$category->status}};
                </script>
                <button type="submit" class="btn btn-primary mb-2 float-md-right">Submit</button>
            </form>
        </div>
        <p class="mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-success">Back to Category List</a>
        </p>
    </div><!-- /.blog-main -->
@stop

@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 border-bottom text-center">Show Category</h3>
        <h4>Name : {{ $category->name }}</h4>

        <p>Slug : {{ $category->slug }}</p>
        <p>Status : {{ $category->status == 1 ? 'Active': 'Inactive' }}</p>
        <p>Date : {{ $category->created_at }}</p>

        <hr>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>Status</th>
                    <th style="width: 20%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php($count = 1)
                @foreach($category->posts as $post)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->status == 1 ? 'Active': 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info demo">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success demo">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger demo" onclick="event.preventDefault(); document.getElementById('deletePost').submit();">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form id="deletePost" action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="return confirm('Are You Sure to Delete');">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <p class="mt-4">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">Edit Category</a>
        </p>
    </div><!-- /.blog-main -->
@stop

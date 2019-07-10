@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 border-bottom text-center">Show Category</h3>
        <h4>Name : {{ $category->name }}</h4>

        <p>Slug : {{ $category->slug }}</p>
        <p>Status : {{ $category->status == 1 ? 'Active': 'Inactive' }}</p>
        <p>Date : {{ $category->created_at }}</p>

        <p class="mt-4">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">Edit Category</a>
        </p>
    </div><!-- /.blog-main -->
@stop

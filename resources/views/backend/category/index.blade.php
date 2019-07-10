@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 border-bottom text-center">Category List</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif
        <a href="{{ route('categories.create') }}" class="btn btn-info mb-2">
            Create
        </a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->status == 1 ? 'Active': 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">
                                Details
                            </a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post" onsubmit="return confirm('Are You Sure to Delete');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div><!-- /.blog-main -->
@stop

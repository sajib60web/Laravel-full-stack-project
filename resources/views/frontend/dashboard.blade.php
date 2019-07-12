@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        @if($user->id == 28)
            <div class="card">
                <ul class="mt-3">
                    @foreach($user->unreadNotifications as $notification)
                    <li>{{ $notification->data['name'] }} Just register</li>
                        @php $notification->markAsRead(); @endphp
                    @endforeach
                </ul>
            </div>
        @endif
        <h3 class="pb-3 mb-4 border-bottom">From the dashboard</h3>
        <img src="{{ asset(optional(auth()->user())->photo) }}" class="img-thumbnail" width="250">

        <p class="mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-success btn-block">Category</a>
        </p>
        <p class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-success btn-block">Post</a>
        </p>
    </div><!-- /.blog-main -->
@stop

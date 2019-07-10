@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            From the Firehose
        </h3>
        @foreach($articles as $article)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">
                {{ $article->created_at->diffForHumans() }} By
                <a href="#">{{ $article->user->name }}</a> On
                <a href="#">{{ $article->category->name }}</a>
            </p>

            <p>
                This blog post shows a few different types of content that's supported and styled with Bootstrap.
                Basic typography, images, and code are all supported.
            </p>
        </div>
        @endforeach
{{--        {{ $articles->links() }}--}}
        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div><!-- /.blog-main -->
@stop

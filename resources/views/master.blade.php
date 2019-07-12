<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Blog</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link href="{{ asset(mix('css/blog.css')) }}" rel="stylesheet">
    <style>
        .demo{
            padding: 1px 5px;
        }
    </style>
</head>
<body>
<div class="container" id="app">
    @include('partials.nav-bar')
{{--    @includeWhen(request()->is('/'), 'partials.jumbotron')--}}
    <main role="main" class="container">
        <div class="row">
            @yield('content')
            @include('partials.sidebar')
        </div><!-- /.row -->
    </main><!-- /.container -->
    @include('partials.footer')
</div>

    <!-- Scripts -->
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <script>
        Echo.channel('post.created')
            .listen('PostCreated', (e) => {
                console.log(e.post);
            });
    </script>
</body>
</html>

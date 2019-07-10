@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 text-center border-bottom">
            Login From
        </h3>
        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" class="form form-horizontal mb-4">
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
                <label>Email Address</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
            </div>
            <button style="float: right;" type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@stop

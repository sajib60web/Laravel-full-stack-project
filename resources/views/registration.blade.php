@extends('master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 text-center border-bottom">
            Registration From
        </h3>
        <form action="{{ route('registration') }}" method="post" enctype="multipart/form-data" class="form form-horizontal mb-4">
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
                <label>Full Name</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control" placeholder="Enter Phone Number">
            </div>
            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('confirm_password') }}" class="form-control" placeholder="Confirm Password">
            </div>
            <button style="float: right;" type="submit" class="btn btn-primary">Registration</button>
        </form>
    </div>
@stop

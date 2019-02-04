@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="{{asset('public/css/login.css')}}">
@endsection
@section('content')
<div class="login-form">
    @if(session()->has('status'))
    <p class="col-md-12 alert alert-success notify_msg">
        {{ session()->get('status') }}
    </p>
    @endif 
    <form method="POST" action="">
        @csrf
        <h3 class="text-center">Register</h3>        
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}"  autofocus placeholder="First Name">
            </div>
            @if ($errors->has('first_name'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}"  autofocus placeholder="Last Name">
            </div>
            @if ($errors->has('last_name'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Email">

            </div>
            @if ($errors->has('email'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Password">
            </div>
            @if ($errors->has('password'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>        
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation"  placeholder="Confirm Password">
            </div>
            @if ($errors->has('password_confirmation'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>   
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
        </div>
    </form>
    <div class="hint-text small">Already have an account? <a href="{{ url('/') }}" class="text-success">Login Now!</a></div>
</div>
@endsection

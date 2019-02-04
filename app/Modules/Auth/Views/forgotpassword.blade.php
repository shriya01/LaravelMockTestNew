

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
        <h3 class="text-center">Forgot Password</h3>        
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
            <button type="submit" class="btn btn-success btn-block login-btn">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</div>
@endsection

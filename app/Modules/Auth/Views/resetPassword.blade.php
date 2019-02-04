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
   <form method="POST" action="{{url('reset-password')}}" aria-label="{{ __('Reset Password') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $data['user_token'] }}">
        <input name="user_id" type="hidden" value="{{ $data['user_id'] or old('user_id') }}">    
        <h3 class="text-center">Reset Password</h3>        
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
            <button type="submit" class="btn btn-success btn-block login-btn">{{ __('Reset Password') }}</button>
        </div>
    </form>
</div>
@endsection

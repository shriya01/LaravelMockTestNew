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
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <p class=" alert alert-danger">
        {{ $error }}
    </p>
    @endforeach
    @endif
    @if(session()->has('status'))
    <p class="col-md-12 alert alert-success notify_msg">
        {{ session()->get('status') }}
    </p>
    @endif 
    <form method="POST" action="">
        @csrf
        <h2 class="text-center">Sign in</h2>        
        <div class="text-center social-btn">
            <a href="{{url('facebook-login')}}" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
            <a href="{{url('github-login')}}" class="btn btn-info btn-block"><i class="fa fa-github"></i> Sign in with <b>Gihub</b></a>
            <a href="{{url('google-login')}}" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
        </div>
        <div class="or-seperator"><i>or</i></div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="{{ url('forgot') }}" class="pull-right text-success">Forgot Password?</a>
        </div>  
    </form>
    <div class="hint-text small">Don't have an account? <a href="{{ url('register') }}" class="text-success">Register Now!</a></div>
</div>
@endsection

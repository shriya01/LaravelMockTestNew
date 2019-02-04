@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="{{asset('public/css/login.css')}}">
@endsection
@section('content')
<div class="container">
	<div class="col-sm-6">
		<form action="{{ url('profile') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" class="form-control" name="first_name" id="first_name" value="{{$first_name}}">
						@if ($errors->has('first_name'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('first_name') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="last_name">Last Name:</label>
				<input type="text" class="form-control" name="last_name" id="last_name" value="{{$last_name}}">
						@if ($errors->has('last_name'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('last_name') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="dob">Date Of Birth:</label>
				<input type="date" class="form-control" id="dob" name="dob" value="{{$dob}}">
					@if ($errors->has('dob'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('dob') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="qualification">Qualification:</label>
				<input type="text" class="form-control" name="qualification" id="qualification" value="{{$qualification}}">
				@if ($errors->has('qualification'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('qualification') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="city">City:</label>
				<input type="text" class="form-control" id="city" name="city" value="{{$city}}">
				@if ($errors->has('city'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('city') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="state">State:</label>
				<input type="text" class="form-control" id="state" name="state" value="{{$state}}">
				@if ($errors->has('state'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('state') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="pincode">Pincode:</label>
				<input type="text" class="form-control" id="pincode" name="pincode" value="{{$pincode}}">
				@if ($errors->has('pincode'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('pincode') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="contact_number">Contact Number:</label>
				<input type="text" class="form-control" name="contact_number" id="contact_number" value="{{$contact_number}}">
				@if ($errors->has('contact_number'))
				<span class="text-danger" role="alert">
					<strong>{{ $errors->first('contact_number') }}</strong>
				</span>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form> 
	</div>
</div>
@endsection
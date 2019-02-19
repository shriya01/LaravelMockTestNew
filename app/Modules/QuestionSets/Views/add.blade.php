@extends('layouts.admin')
@section('scripts')
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
	tinymce.init({
		selector: '#answer,#question'
	});
</script>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
			<i class="fa fa-table"></i> Add Question
			<a class="btn btn-primary pull-right" href=" {{ url('/') }}/examination"> {{__('Section::messages.go_back')}}</a>
		</h3>
	</div>
</div>
<div class="row">
	@if(isset($questions))
								@foreach($questions as $key)
								<?php 
								$question = $key->question;
								$correct_option_value = $key->correct_option_value;
								$answer = $key->answer;
								?>
								@endforeach
								@endif
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Add Question
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<form role="form" method="post" action="" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{$id}}">
							<input type="hidden" name="section_id" value="{{$section_id}}">
							<input type="hidden" name="question_id" value="{{$question_id}}">
							<div class="form-group">
								<label>Question Name</label>
								<input class="form-control" id ="question" name="question" value="{{$question}}" >
								@if ($errors->has('question'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('question') }}</strong>
								</span>
								@endif
							</div>
							@for($column="A"; $column <= "E"; $column++)
							<div class="form-group">
								<label>Option {{$column}}</label>
								@if(isset($questions))
								@foreach($questions as $key)
								<?php 
								$columnName = 'option_'.$column;
								$columnName = $key->$columnName;
								?>
								<input class="form-control" name="{{'option_'.$column}}" value="{{ $columnName }}">
								@endforeach
								@else
								<input class="form-control" name="{{'option_'.$column}}" value="">
								@endif
								@if ($errors->has('option_'.$column))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('option_'.$column) }}</strong>
								</span>
								@endif
							</div>
							@endfor
							<div class="form-group">
								<label>Correct Option Value</label>
								<input class="form-control" name="correct_option_value" value="{{$correct_option_value}}">
								@if(session()->has('error'))
								<span class="text-danger" role="alert">     
									<strong>{{ session()->get('error') }}</strong>   
								</span>
								@endif 
								@if ($errors->has('correct_option_value'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('correct_option_value') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group">
								<label>Answer Explaination</label>
								<input class="form-control" id ="answer" name="answer" value="{{$answer}}" >
								@if(session()->has('error'))
								<span class="text-danger" role="alert">     
									<strong>{{ session()->get('error') }}</strong>   
								</span>
								@endif 
								@if ($errors->has('answer'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('answer') }}</strong>
								</span>
								@endif
								@if(empty($question_id))
								<label>Answer Image</label>
								<input type="file" name="image">
								@endif
							</div>
							<div>
								@if(isset($directions))     
								<label>Direction</label>
								<select name="directions">              
									<option value="">Select Directions</option>
									@foreach($directions as $key)
									<option value="{{$key->id}}">{{$key->direction_set_name}}</option>
									@endforeach
								</select>
								@endif
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection



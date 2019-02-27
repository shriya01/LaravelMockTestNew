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
			<i class="fa fa-table"></i> {{__('QuestionSets::messages.add_que')}}
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
				{{__('QuestionSets::messages.add_que')}}
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<form role="form" method="post" action="" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{$id}}">
							<input type="hidden" name="section_id" value="{{$section_id}}">
							<input type="hidden" name="question_id" @if(isset($question_id)) value="{{$question_id}}" @endif>
							<div class="form-group">
								<label>{{__('QuestionSets::messages.que')}}</label>
								<input class="form-control" id ="question" name="question" @if(isset($question)) value="{{$question}}" @endif>
								@if ($errors->has('question'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('question') }}</strong>
								</span>
								@endif
							</div>
							@for($column="A"; $column <= "E"; $column++)
							<div class="form-group">
								<label>{{__('QuestionSets::messages.option')}} {{$column}}</label>
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
								<label>{{__('QuestionSets::messages.correct_option')}}</label>
								<input class="form-control" name="correct_option_value" @if(isset($correct_option_value)) value="{{$correct_option_value}}" @endif >
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
								<label>{{__('QuestionSets::messages.ans_ex')}}</label>
								<input class="form-control" id ="answer" name="answer" @if(isset($answer)) value="{{$answer}}" @endif >
								@if ($errors->has('answer'))
								<span class="text-danger" role="alert">
									<strong>{{ $errors->first('answer') }}</strong>
								</span>
								@endif
								@if(empty($question_id))
								<label>{{__('QuestionSets::messages.ans_im')}}</label>
								<input type="file" name="image" multiple="multiple">
								@endif
							</div>
							<div>
								@if(isset($directions))     
								<label>{{__('Directions::messages.direction_guidelines')}}</label>
								<select name="directions">              
									<option value="">{{__('Directions::messages.sel_dir_guide')}}</option>
									@foreach($directions as $key)
									<option value="{{$key->id}}">{{$key->direction_set_name}}</option>
									@endforeach
								</select>
								@endif
							</div>
							<button type="submit" class="btn btn-default">{{__('Section::messages.submit')}}</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection



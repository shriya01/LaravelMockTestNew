@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="{{asset('public/css/login.css')}}">

@endsection

@section('content')
<div class="container-fluid">
  <div><h1 align="center" width="50%">Other Important Instructions</h1></div>
  <div>
    <h4>General Instructions:</h4>
    <ul>
      <li><h6>The total duration of the examination is 180 minutes</h6></li>
      <li><h6>Marked for review status for a question simply indicates that you would like to review the question again.</h6></li>
      <li><h6>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available to you for completing the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</h6></li>
      <li><h6>Please note that if a question is answered and ‘marked for review’, your answer for that question will be considered in the evaluation.</h6></li>
      <li><h6>You can click on the question palette to navigate faster across questions.</h6></li>
      <li><h6>You can click on the question palette to navigate faster across questions.</h6></li>
      <li><h6>You can click on the question palette to navigate faster across questions.</h6></li>
    </ul>
  </div>
  <div>
    <h4>Answering a Question:</h4>
    <ul>
      <li><h6>To mark a question for review, click on the Mark for Review & Next button.</h6></li>
      <li><h6>To change answer to a question that has already been answered, select that question from the Question Palette and then follow the procedure for answering that type of question.</h6></li>
      <li><h6>Note that ONLY questions for which answers are either saved or marked for review after answering, will be considered for evaluation</h6></li>
      <li><h6>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</h6></li>
    </ul>
  </div>
  <div>
    <div class="form-group">
      <label>Choose your default Language</label>
      <select name="examination_name" > 
        <option value="">Select Examination</option>
        <option value="">hindi</option>
        <option value="">english</option>
      </select> Please note that all question will appear in your default language. This language can't be changed after-words.
      @if ($errors->has('section'))
      <span class="text-danger" role="alert">
        <strong></strong>
      </span>
      @endif
    </div>
    <div class="form-group">
      <input type="checkbox" name="section[]" value="">
      I have read and understood all the instructions. I understand that using unfair means of any sort for any advantage will lead to immediate disqualification. The decision of ixambee.com will be final in these matters.
      @if ($errors->has('section'))
      <span class="text-danger" role="alert">
        <strong>{{ $errors->first('section') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div>
    <a href="#" class="btn btn-success editTag btn-sm mr-2 tags-edit" align="left"><<--Previous</a>
    <a href="#" class="btn btn-success editTag btn-sm mr-2 tags-edit" align="right">I an ready to begin--->>></a>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('public/theme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/theme/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/theme/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
<script>
$(document).ready(function() {
  $('#dataTables-example').DataTable({
    responsive: true
  });
});
</script>
@endsection
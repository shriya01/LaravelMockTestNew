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
  <div><h1 align="center" width="50%">Please read instructions carefully</h1></div>
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
  <div class="panel panel-primary">
    @if(isset($test))       
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Test Name</th>
          <th>No.of Questions</th>
          <th>Marks</th>
          <th>Medium of Exam</th>
          <th>Time Allotted</th>
        </tr>
      </thead>
      <tbody>
        @foreach($test as $key=>$value)
        <tr>                   
          <td>{{$value->section_name}}</td>
          <td>{{$value->no_of_question}}</td>
          <td>{{$value->marks}}</td>
          <td>{{$value->medium_of_exam}}</td>
          <td>{{$value->time_allotted}}</td>
        </tr>
        @endforeach
        <tr>
          <td>total</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    @endif
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
  <div align="right"><a href="{{ url('/') }}/importantInstructions/{{ $value->examination_id }}/{{ $value->test_id }}" class="btn btn-success editTag btn-sm mr-2 tags-edit">Next--->>></a></div>   
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
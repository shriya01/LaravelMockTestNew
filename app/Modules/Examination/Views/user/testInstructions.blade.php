@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="{{asset('public/css/login.css')}}">
<style type="text/css">
.table {
    width: 98%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-left: 2%;
}
h4{
    margin-left: 2%;
}
</style>
@endsection
@section('content')
<div class="container-fluid" id="container">
    <div id="next"></div>
    <div id="question">
        <div class="col-sm-2 pull-right" id="questions_switch"></div>
        <div class="col-sm-10 pull-left" id="question_panel">
            <div id="timer"></div>
        </div>
    </div>
    <div class="panel panel-info" id="instruction">
        <div class="panel-heading">General Instructions:</div>
        <div class="panel-body">
            <div><h4 align="left" >Please read instructions carefully</h4></div>
            <ul>
                <li><h4>The total duration of the examination is {{$total_time}} minutes</h4></li>
                <li><h4>Marked for review status for a question simply indicates that you would like to review the question again.</h4></li>
                <li><h4>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available to you for completing the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</h4></li>
                <li><h4>Please note that if a question is answered and ‘marked for review’, your answer for that question will be considered in the evaluation.</h4></li>
                <li><h4>You can click on the question palette to navigate across questions.</h4></li>
            </ul>
            @if(isset($test))       
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th>No.of Questions</th>
                        <th>Time Allotted</th>
                        <th>Max Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($test as $key=>$value)
                    <tr>                   
                        <td>{{$value->section_name}}</td>
                        <td>{{$value->max_question}}</td>
                        <td>{{$value->max_time." Minutes"}}</td>
                        <td>{{$value->max_marks }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>total</td>
                        <td>{{ $total_questions }}</td>
                        <td>{{ $total_time." Minutes" }}</td>
                        <td>{{ $total_marks }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            <h4>Answering a Question:</h4>
            <ul>
                <li><h4>To mark a question for review, click on the Mark for Review & Next button.</h4></li>
                <li><h4>To change answer to a question that has already been answered, select that question from the Question Palette and then follow the procedure for answering that type of question.</h4></li>
                <li><h4>Note that ONLY questions for which answers are either saved or marked for review after answering, will be considered for evaluation</h4></li>
                <li><h4>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</h4></li>
            </ul>
            <button  class="next pull-right btn btn-primary  btn-sm mr-2">Next</button>
             <div class="btn-group btn-sm-2"  />
  <div class="btn-group">
    <button type="button" style="background-color: #7442f4" class="btn btn-primary">Mark for review</button>
  </div>

</div> 
        </div>
    </div>
</div>  
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function() {
        jQuery('.next').click(function() {
            $('#instruction').html(' <div class="panel-heading"><b>Other Important Instructions</b></div><div class="panel-body"><h4><b>Read the following Instruction carefully:</b></h4><ul><li><h4>This test comprises of multiple-choice questions.</h4></li><li><h4>Each question will have only one of the available options as the correct answer.</h4></li><li><h4>You are advised not to close the browser window before submitting the test.</h4></li><li><h4>In case, if the test does not load completely or becomes unresponsive, click on browser refresh button to reload.</h4></li></ul><h4><b>Marking Scheme:</b></h4><ul><li><h4>1 mark(s) will be awarded for each correct answer.</h4></li><li><h4>0.25 mark(s) will be deducted for every wrong answer.</h4></li><li><h4>No marks will be deducted/awarded for un-attempted questions</h4></li></ul><h5><b>Choose your default Language</b><select id="drop"><option value="">Select your Language</option><option value="english">English</option><option value="hindi"> Hindi</option></select><span>Please note that all question will appear in your default language. This language can not be changed after-words.</span></h5><h5 class="pad10"><input type="checkbox" name="" value="" id="checkbeforeexam" class="checkboxset">&nbsp; I have read and understood all the instructions. I understand that using unfair means of any sort for any advantage will lead to immediate disqualification. The decision of ixambee.com will be final in these matters.</h5><a href="#" class="pull-left btn btn-primary  btn-sm mr-2" align="left"><<--Previous</a><a id="loadQuestion" class="pull-right btn btn-primary  btn-sm mr-2" align="right">I an ready to begin--->>></a></div>');
        });
        $("#container").on('click', '#loadQuestion', function () {
            var id = $("#drop").val();
            var check = $('input[type="checkbox"]').is(':checked');
            var test_name = '{{$test_name}}';
            if(id && check)
            {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('loadQuestion') }}",
                    type: 'post',
                    data:{test_name:test_name},
                    dataType:'json',
                    success: function(result) {
                        var date = new Date();                                                       
                        $.each(result, function (i) {
                            $.each(result[i], function (key, val) { 
                                loadQuestion(test_name,val);
                            });
                        });
                        $("#instruction").empty().hide();
                    }
                });
            }
            else if(id == ''){
                alert('please select language');
            }
            else{
                alert('please accept terms');
            }
        });
        $("#container").on('click', '.question_switch', function () {
            var id = $(this).val();
            var desired = id.replace(/[^\w\s]/gi, '')
            loadQuestionByID(id);
        });
    });
    function loadQuestion(test_name,section_id) {
        var d = new Date();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ route('loadQuestionBySection') }}",
            type: 'post',
            data:{test_name:test_name,section_id:section_id},
            success: function(result) {
                $("#instruction").empty().hide();
                $("#questions_switch").append(result);
                loadQuestionByID(1);
            },
        });
    } 
    function  loadQuestionByID(id) {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ route('loadQuestionByID') }}",
            type: 'post',
            data:{id:id},
            success: function(result) {
                $("#instruction").empty().hide();
                $("#question_panel").html(result);
            }
        });
    }
</script>
@endsection
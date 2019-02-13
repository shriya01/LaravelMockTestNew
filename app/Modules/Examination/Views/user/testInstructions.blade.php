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
h4
{
    margin-left: 2%;
}
</style>
@endsection
@section('content')
<div class="container">
    <div id="question">

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
        </div>
    </div>
</div>  
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function() {
        var value = attrid ='';
        jQuery('.next').click(function() {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('importantInstructions') }}",
                type: 'post',
                success: function(result) {
                    $('#instruction').html(result);
                },
                error:function(xhr)
                {
                    alert('Sorry for the incovenice. something went wrong please try again later');
                }
            });
        });
        $(".container").on('click', '#loadQuestion', function () {
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
                    success: function(result) {
                        $('#question').html(result);
                        $('#instruction').hide();
                    },
                    error:function(xhr)
                    {
                        console.log(xhr);
                    }
                });
            }
            else if(id == '')
            {
                alert('please select language');
            }
            else{
                alert('please accept terms');
            }
        });

        $(".container").on('click', '.question_switch', function () {
            var id = $(this).val();
            console.log(id);
        });
        
    });
</script>
@endsection
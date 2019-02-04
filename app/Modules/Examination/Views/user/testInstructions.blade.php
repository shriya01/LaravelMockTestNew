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
    <div class="panel panel-info">
        <div class="panel-heading">General Instructions:</div>
        <div class="panel-body">
            <div><h2 align="left" >Please read instructions carefully</h2></div>
            <ul>
                <li><h5>The total duration of the examination is 180 minutes</h5></li>
                <li><h5>Marked for review status for a question simply indicates that you would like to review the question again.</h5></li>
                <li><h5>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available to you for completing the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</h5></li>
                <li><h5>Please note that if a question is answered and ‘marked for review’, your answer for that question will be considered in the evaluation.</h5></li>
                <li><h5>You can click on the question palette to navigate faster across questions.</h5></li>
                <li><h5>You can click on the question palette to navigate faster across questions.</h5></li>
                <li><h5>You can click on the question palette to navigate faster across questions.</h5></li>
            </ul>
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
                    <?php $total = 0; ?>
                    @foreach($test as $key=>$value)
                    <tr>                   
                        <td>{{$value->section_name}}</td>
                        <td>{{$value->max_question}}</td>
                        <td>{{$value->marks}}</td>
                        <td>{{$value->medium_of_exam}}</td>
                        <td>{{$value->time_allotted}}</td>
                    </tr>
                    <?php $total += $value->max_question; ?>
                    @endforeach
                    <tr>
                        <td>total</td>
                        <td>{{ $total }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            @endif
            <h4>Answering a Question:</h4>
            <ul>
                <li><h5>To mark a question for review, click on the Mark for Review & Next button.</h5></li>
                <li><h5>To change answer to a question that has already been answered, select that question from the Question Palette and then follow the procedure for answering that type of question.</h5></li>
                <li><h5>Note that ONLY questions for which answers are either saved or marked for review after answering, will be considered for evaluation</h5></li>
                <li><h5>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</h5></li>
            </ul>
            <a href="" class=" pull-right btn btn-primary  btn-sm mr-2">Next</a>
        </div>
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
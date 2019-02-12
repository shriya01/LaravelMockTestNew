@extends('layouts.admin')
@section('styles')
<!-- DataTables CSS -->
<link href="{{asset('public/theme/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{asset('public/theme/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <i class="fa fa-table"></i> {{ __('messages.mock_tests') }}
            <a class="btn btn-primary pull-right" id="add">{{ __('MockTest::messages.add_question_to_mock_test') }}</a>
        </h3>
    </div>
    <select name="section_name" id="section_name"> 
            <option value="">Select Section</option>
        @foreach($sections as $key)
            <option value="{{$key->id}}">{{$key->section_name}}</option>
        @endforeach
    </select>
    <hr />
    <div class="row">
        @if(session()->has('status'))
        <p class="col-md-12 alert alert-success notify_msg">
            {{ session()->get('status') }}
        </p>
        @endif
    </div>
    <div class="row col-sm-12">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Mock Test Table
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Section Name</th>
                                <th>Max Question</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($users))                   
                            @foreach($users as $key)
                            <tr class="odd gradeX">
                                <td>{{$key->section_name}}</td>
                                <td class="text-center">
                                    {{$key->max_question}}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="questions" class="col-sm-6">
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
        $('#add').click(function(){
            $('#question').show();
        });
        $('#section_name').change(function(){
            var id = ($(this).val());
            var section_id =  $('#section_name').val();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('showQuestions') }}",
                method: 'post',
                data:{
                    section_id:section_id,
                },
                success: function(result) {
                    $('#questions').empty();
                    $('#questions').append(result);   
                    $('#dataTables-example2').DataTable({
                responsive: true
                });
                },
                error:function(xhr)
                {
                    console.log(xhr);
                }
            });
        });
        $("#questions").on('click', 'input:checkbox[class=checkall]', function () {
                $('.check').prop('checked', $(this).prop('checked'));
            });

        $("#questions").on('click', '#ques', function () {
            var questions = [];
            $.each($("input:checkbox[class=check]:checked"), function(){            
                questions.push($(this).val());
            });
            questions = questions.join(", ");
            var test_name = "{{$test_name}}";
            var section_id =  $('#section_name').val();
            var category_id = $('#category_name').val();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('addQuestions') }}",
                method: 'post',
                data:{
                    test_name:test_name,
                    questions:questions,
                    section_id:section_id,
                    category_id:category_id,
                },
                success: function(result) {
                  console.log(result);
                },
                error:function(xhr)
                {
                    console.log(xhr);
                }
            });
                    
        });
    });
</script>
@endsection
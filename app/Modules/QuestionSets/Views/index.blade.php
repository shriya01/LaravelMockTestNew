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
            <i class="fa fa-table"></i> Questions
            <a class="btn btn-primary pull-right" href=" {{ url('/') }}/addQuestion/{{$id}}/{{$section_id}}">Add Question</a>
        </h3>
    </div>
</div>
<div class="row">
    @if(session()->has('status'))
    <p class="col-md-12 alert alert-success notify_msg">
        {{ session()->get('status') }}
    </p>
    @endif 
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Mock Test Table
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Option E</th>
                            <th>Correct Option</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($questions))                   
                        @foreach($questions as $key)
                        
                        <tr class="odd gradeX">
                            <td width="50%">{{$key->question}}</td>
                            @for($column="A"; $column <= "E"; $column++)
                                <?php 
                                    $column_name = 'option_'.$column;
                                ?>
                                <td>{{ $key->$column_name}}</td>
                            @endfor
                            <td>{{$key->correct_option_value}}</td>
                            <td><a class="btn btn-primary" data-toggle="tooltip" title="View Answer Explaination" href="{{ route('addHint',Crypt::encrypt($key->id)) }}"><span class="fa fa-eye"></span></a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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
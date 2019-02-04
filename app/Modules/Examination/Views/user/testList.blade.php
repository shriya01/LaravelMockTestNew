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
  <div class="panel panel-primary">
    @if(isset($test))       
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Test Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($test as $key=>$value)
        <tr>                   
          <td>{{$value->test_name}}</td>
          <td>
            <a href="{{ url('/') }}/testInstructions/{{ $value->examination_id }}" target="_blank" class="btn btn-success editTag btn-sm mr-2 tags-edit">Take Test</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
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
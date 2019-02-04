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
      <div class="panel-heading">Examination</div>
      @if(isset($examinations))       
      <ul class="list-group">
        @foreach($examinations as $key)
        <li class="list-group-item"><a href="{{ route('showTest',$key['id']) }}">{{$key['examination_name']}}</a></li>
        @endforeach
      </ul>
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
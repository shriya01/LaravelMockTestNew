@extends('layouts.admin')
@section('content')
<div class="col-sm-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <br />

    @foreach ($sections as $key)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Section Name</th>
                <td>{{$key['section_name']}}</td>
            </tr>
        </thead>
    </table>
    @endforeach  
    <a href="{{ url('section') }}"><button class="btn-sm btn-primary glyphicon glyphicon-back">Go Back</button></a>
</div>
@endsection
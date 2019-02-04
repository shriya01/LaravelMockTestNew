@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <i class="fa fa-table"></i> Add Mock Test
            <a class="btn btn-primary pull-right" href=" {{ url('/') }}/examination"> {{__('Section::messages.go_back')}}</a>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Mock Test
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" method="post" action="">
                            @csrf
                            <div class="form-group">
                                <label>Mock Test Name</label>
                                <input class="form-control" name="test_name" value="" >
                                @if ($errors->has('test_name'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('test_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                @foreach($sections as $key)
                                    <input type="checkbox" name="section[]" value="{{$key->id}}">{{$key->section_name}}
                                    <input type="text" name="max_question[]">
                                @endforeach
                                @if ($errors->has('section'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Examination</label>
                                <select name="examination_name" > 
                                    <option value="">Select Examination</option>
                                    @foreach($examinations as $key)
                                    <option value="{{$key->id}}">{{$key->examination_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('examination_name'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('examination_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">{{__('Section::messages.submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
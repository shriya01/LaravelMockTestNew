@extends('layouts.admin')
@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <h3 class="page-header">
            	<i class="fa fa-table"></i> Add Examination
            	<a class="btn btn-primary pull-right" href=" {{ url('/') }}/examination"> {{__('Section::messages.go_back')}}</a>
			</h3>
	    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Examination
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="">
                            	@csrf
                                <div class="form-group">
                                    <label>Examination Name</label>
                                    <input class="form-control" name="examination_name" @if(isset($examinations))  value="{{$examinations[0]['examination_name']}}" @endif">
                                     @if ($errors->has('examination_name') || session()->has('error'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('examination_name') }}</strong>
                                            <strong>{{ session()->get('error') }}</strong>
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
@extends('layouts.admin')
@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <h3 class="page-header">
            	<i class="fa fa-table"></i>{{ __('Section::messages.add_section') }}
            	<a class="btn btn-primary pull-right" href=" {{ url('/') }}/section"> {{__('Section::messages.go_back')}}</a>
			</h3>
	    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('Section::messages.add_section')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="">
                            	@csrf
                                <div class="form-group">
                                    <label>{{__('Section::messages.section_name')}}</label>
                                    <input class="form-control" name="section_name" @if(isset($sections))  value="{{$sections[0]['section_name']}} @endif">
                                     @if ($errors->has('section_name') || session()->has('error'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('section_name') }}</strong>
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
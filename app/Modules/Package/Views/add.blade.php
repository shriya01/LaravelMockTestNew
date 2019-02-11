@extends('layouts.admin')
@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <h3 class="page-header">
            	<i class="fa fa-table"></i>{{ trans('Package::messages.add_package')}}
            	<a class="btn btn-primary pull-right" href=" {{ url('/') }}/examination"> {{__('Section::messages.go_back')}}</a>
			</h3>
	    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('Package::messages.add_package')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="">
                            	@csrf
                                @if(isset($packages)) 
                                <input type="hidden" name="id" value="{{Crypt::encrypt($packages[0]['id'])}}">
                                @endif
                                <div class="form-group">
                                    <label>{{__('Package::messages.package_name')}}</label>
                                    <input class="form-control" name="package_name" @if(isset($packages))  value="{{$packages[0]['package_name']}}" @endif">
                                     @if ($errors->has('package_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('package_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                       <div class="form-group">
                                    <label>{{__('Package::messages.package_type')}}</label>
                                    <input class="form-control" name="package_type" @if(isset($packages))  value="{{$packages[0]['package_type']}}" @endif">
                                     @if ($errors->has('package_type'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('package_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{__('Package::messages.package_price')}}</label>
                                    <input class="form-control" name="package_price" @if(isset($packages))  value="{{$packages[0]['package_price']}}" @endif">
                                     @if ($errors->has('package_price'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('package_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{__('Package::messages.package_validity')}}</label>
                                    <input class="form-control" name="package_validity" @if(isset($packages))  value="{{$packages[0]['package_validity']}}" @endif">
                                     @if ($errors->has('package_validity'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('package_validity') }}</strong>
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
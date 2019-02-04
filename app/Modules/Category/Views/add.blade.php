@extends('layouts.admin')
@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <h3 class="page-header">
            	<i class="fa fa-table"></i>{{__('Category::messages.add_category')}}
            	<a class="btn btn-primary pull-right" href=" {{ url('/') }}/examination"> {{__('Section::messages.go_back')}}</a>
			</h3>
	    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('Category::messages.add_category')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="">
                            	@csrf
                                @if(isset($categories)) 
                                <input type="hidden" name="id" value="{{Crypt::encrypt($categories[0]['id'])}}">
                                @endif
                                <div class="form-group">
                                    <label>{{__('Category::messages.category_name')}}</label>
                                    <input class="form-control" name="category_name" @if(isset($categories))  value="{{$categories[0]['category_name']}}" @endif">
                                     @if ($errors->has('category_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('category_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{__('Section::messages.section')}}</label>
                                    <select name="section_name" > 
                                        <option value="">{{__('Category::messages.select_section')}}</option>
                                        @foreach($sections as $key)
                                            @if(isset($categories) && $categories[0]['section_id'] == $key->id)   
                                            <option value="{{$key->id}}" selected="">{{$key->section_name}}</option>
                                            @else
                                            <option value="{{$key->id}}" >{{$key->section_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                       @if ($errors->has('section_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('section_name') }}</strong>
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
@extends('layouts.admin')
@section('scripts')
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#post_description'
    });
</script>
@endsection
@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <h3 class="page-header">
            	<i class="fa fa-table"></i>{{__('Post::messages.add_post')}}
            	<a class="btn btn-primary pull-right" href=" {{ url('/') }}/section"> {{__('Section::messages.go_back')}}</a>
			</h3>
	    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('Post::messages.add_post')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="">
                            	@csrf
                                <div class="form-group">
                                    <label>{{__('Post::messages.add_post')}}</label>
                                    <input class="form-control" name="post_name">
                                     @if ($errors->has('post_name') || session()->has('error'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('post_name') }}</strong>
                                            <strong>{{ session()->get('error') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Post Description</label>
                                    <textarea class="form-control"  id="post_description" name="post_description"></textarea>
                                    @if(session()->has('error'))
                                    <span class="text-danger" role="alert">     
                                        <strong>{{ session()->get('error') }}</strong>   
                                    </span>
                                    @endif 
                                    @if ($errors->has('post_description'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('post_description') }}</strong>
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
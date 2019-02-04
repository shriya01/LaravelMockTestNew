@extends('layouts.admin')
@section('scripts')
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#direction_guidelines'
    });
</script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <i class="fa fa-table"></i>{{ __('Directions::messages.add_direction_guideline') }}
            <a class="btn btn-primary pull-right" href=" {{ url('/') }}/section"> {{__('Section::messages.go_back')}}</a>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{__('Directions::messages.add_direction_guideline')}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" method="post" action="">
                            @csrf
                            @if(isset($id))<input type="hidden" name="id" value="{{$id}}"> @endif
                            <div class="form-group">
                                <label>{{__('Directions::messages.direction_guideline_name')}}</label>
                                <input class="form-control" name="direction_guideline_name" @if(isset($directions))  value="{{$directions[0]->direction_set_name }}" @endif>
                                @if ($errors->has('direction_name') || session()->has('error'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('direction_name') }}</strong>
                                    <strong>{{ session()->get('error') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('Directions::messages.direction_guidelines')}}</label>
                                <textarea class="form-control" id="direction_guidelines"  name="direction_guidelines">
                                    @if(isset($directions))  {!! $directions[0]->directions !!} @endif
                                </textarea>
                                @if(session()->has('error'))
                                <span class="text-danger" role="alert">     
                                    <strong>{{ session()->get('error') }}</strong>   
                                </span>
                                @endif 
                                @if ($errors->has('answer'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('answer') }}</strong>
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
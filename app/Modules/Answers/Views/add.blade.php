@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            <i class="fa fa-table"></i>  
            @if(!empty($answers)) 
            View Answer
            @else
            Add Answer
            @endif
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
            @if (session()->has('status'))
            <div class="alert alert-success" >
                <strong>{{ session()->get('status') }}</strong>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(!empty($answers)) 
                    View Answer
                    @else
                    Add Answer
                    @endif
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(!empty($answers))
                                @foreach($answers as $key)
                                    <strong>{{'Question:-'}}</strong> {!! (ucwords($key->question)) !!}<br/>
                                    <strong>{{'Options:-'}}</strong>
                                    @for($column="A"; $column <= "D"; $column++)
                                        <?php $columnname = 'option_'.$column;?>
                                        <br/>
                                        {{$key->$columnname}}
                                    @endfor
                                    <br/>
                                    <strong>{{'Correct Answer:- '}}</strong>{{$key->correct_option_value}}
                                    <br/>
                                    <strong>{{'Answer Explaination:- '}}</strong>{!! $key->answer !!}
                                @endforeach
                            @else
                                <p>No Explaination Available<p>
                            @endif
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
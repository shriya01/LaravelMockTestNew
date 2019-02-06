<!DOCTYPE html>
<html>
<head>
    <title>Receipt PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="row">
                <?php $i = 1; ?>
                @if(isset($result))                   
                    @foreach($result as $key)
                    <h5><strong>Section : - {{ $key->section_name}} </strong></h5>
                    <div style="font-size: 12px !important"><strong>
                    <img src="{{asset('public/images/'.$key->image_name)}}">
                    Question : -{{$i}} {!! $key->question !!}</strong>
                    @for($column="A"; $column <= "E"; $column++)
                    <?php 
                    $column_name = 'option_'.$column;
                    ?>
                    <li>{{ $key->$column_name}}</li>
                    @endfor
                    <p>Correct Answer : {{$key->correct_option_value}}</p>
                    <p>Answer Explaination - {!! $key->answer !!}</p>
                    <hr />
                    </div>
                   <?php  $i++; ?>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
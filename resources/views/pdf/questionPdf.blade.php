<!DOCTYPE html>
<html>
<head>
    <title>Receipt PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="utf-8">
    <style type="text/css">
        .no-break {
            page-break-inside: avoid;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="row">
                    <?php $i = 1; ?>
                    @if(isset($result))                   
                        @foreach($result as $key)
                        <strong>Section : - {{ $key->section_name}}</strong><p>
                        <div style="font-size: 12px !important color:black !important">
                           @if(isset($key->section_name))
                           Directions : - {!! $key->directions !!}
                            @endif
                            @if(isset($key->image_name))
                            <div class="no-break">
                                <img style="width:500px; height:300px; " src="{{asset('public/images/'.$key->image_name)}}">
                            </div>
                            @endif
                            <br/>
                        Question : -{{$i}} {!! $key->question !!}
                        @for($column="A"; $column <= "E"; $column++)
                        <?php 
                        $column_name = 'option_'.$column;
                        ?>
                        <li>{{ $key->$column_name}}</li>
                        @endfor
                        <p>Correct Answer : {{$key->correct_option_value}}</p>
                        <p>Answer Explaination - {!! $key->answer !!}</p>
                        @if(isset($key->answer_image))
                            Answer Image
                            <div class="no-break">
                                <img style="width:500px; height:300px; " src="{{asset('public/images/'.$key->answer_image)}}">
                            </div>
                            @endif
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
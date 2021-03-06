<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Ask Bot
        </div>

        <div class="col-md-6" style="margin-left:300px ">
            <div class="input-group">
                <input id="ask" type="text" class="form-control" value="{!!isset($query) ? $query : ''!!}"
                       placeholder="Search for..." aria-label="Search for...">
                <span class="input-group-btn">
        <button class="btn btn-secondary" type="button" onclick="onClickGO()">Go!</button>
      </span>
            </div>
        </div>
        @if(isset($result))
            <h1>You have {{$result->count()}} locations marked for the criteria.</h1>

            <div class="col-md-6" style="margin-left: 300px">
                <div class="list-group">
                    @foreach($result as $item)
                        <a href="https://www.google.com/maps/?q={{$item->float1}},{{$item->float2}}" target="_blank"
                           class="list-group-item">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$item->float1}},{{$item->float2}}&zoom=17&size=100x100&markers={{$item->float1}},{{$item->float2}}&maptype=roadmap&format=png&key=AIzaSyBgvAHuj4BBj00hldnDbzklX76854EEy8Y"
                                 alt="{{$item->state}}">
                            <span>{{$item->string2 . ' ' . $item->string3}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($errorString))
            <h1>Sorry, I could not undertand please try something else.</h1>
        @endif

    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>

<script>
    function onClickGO() {
        console.log('clicked')
        window.location = "ask?query=" + $('#ask').val();
    }

    $("#ask").keyup(function (event) {
        if (event.keyCode === 13) {
            $("#go").click();
        }
    });
</script>
</html>

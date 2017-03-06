<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="{!! URL::to('/') !!}/js/codemirror.js"></script>
        <link rel="stylesheet" href="{!! URL::to('/') !!}/css/codemirror.css">
        <script src="{!! URL::to('/') !!}/js/javascript/javascript.js"></script>

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

            .full-width {
                width: 100vh;
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

            textarea {
               resize: none;
               height: 25vh;
               width: 100vh;
            }
        </style>
    </head>
    <body>
        {!! Form::open(array('url' => 'register/edit')) !!}
        {!! Form::hidden('website', $website) !!}
        <br/>
        {!! Form::submit('Edit') !!}
        {!! Form::close() !!}
        <div class="flex-center position-ref full-height">
            <p>{{$website}}</p>
            <p>Your access_key is {{$access_key}}</p>
            <p>Your business_id is {{$business_id}}</p>
            <h3>You have finished all the configuration. Now, implement this javascript inside your product &amp; checkout page!</h3>
            <br/>
            <div id="js-code">
                <script type="text/javascript">
                    var text = `<script>
\twindow.ren = window.ren || function() {
\t\t(ren.q = ren.q || []).push(arguments);
\t};

\tren("register", your_access_key);
\tren("view", 'business_id;user_id', 'business_id;product_id'); 
\tren("buy", 'business_id;user_id', 'business_id;product_id');
<\/script>
<script async src="{!! URL::to('/'); !!}/js/recomen.js"><\/script>`;
                    var ce = document.getElementById("js-code");
                    var myCodeMirror = CodeMirror(function(node){ce.parentNode.replaceChild(node, ce);}, {
                      value: text,
                      mode:  "javascript",
                      readOnly: true,
                      lineNumbers: true,
                      lineWrapping: true
                    });
                </script>
            </div>
            <h3>Call this API to get the recommendation!</h3>
            <br/>
            <div id="api-code"></div>
            <script type="text/javascript">
                    var text = `POST: http://localhost:8082/queries.json
\t\tparameters:
\t\t\t{
\t\t\t\tuser:"business_id;user_id"
\t\t\t\titem="business_id;item_id"
\t\t\t}`;
                    var ce = document.getElementById("api-code");
                    var myCodeMirror = CodeMirror(function(node){ce.parentNode.replaceChild(node, ce);}, {
                      value: text,
                      mode:  "javascript",
                      readOnly: true,
                      lineNumbers: true,
                      lineWrapping: true
                    });
                </script>
        </div>
    </body>
</html>

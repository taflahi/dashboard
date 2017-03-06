<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        @if (session('status'))
            <div class="alert alert-success full-width">
                {{ session('status') }}
            </div>
        @endif
            <div>
                {!! Form::open(array('url' => 'crawler')) !!}
                {!! Form::hidden('website', $website) !!}
                {!! Form::hidden('business_id', $business_id) !!}
                {!! Form::hidden('access_key', $access_key) !!}
                <br/>
                {!! Form::label('product-list', 'Input your product listing url') !!}
                {!! Form::text('product-list') !!}
                <br/>
                <br/>
                {!! Form::label('product-url-css', 'Product page url css') !!}
                {!! Form::text('product-url-css') !!}
                <br/>
                {!! Form::label('next-url-css', 'Next page url css') !!}
                {!! Form::text('next-url-css') !!}
                <br/>
                <br/>
                {!! Form::label('product-code-css', 'Product unique code css') !!}
                {!! Form::text('product-code-css') !!}
                <br/>
                {!! Form::label('product-name-css', 'Product name css') !!}
                {!! Form::text('product-name-css') !!}
                <br/>
                {!! Form::label('product-price-css', 'Product price css') !!}
                {!! Form::text('product-price-css') !!}
                <br/>
                {!! Form::label('product-image-css', 'Product image css') !!}
                {!! Form::text('product-image-css') !!}
                <br/>
                {!! Form::label('product-category-css', 'Product category css') !!}
                {!! Form::text('product-category-css') !!}
                <br/>
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
                @if(!empty($edit))
                {!! Form::open(array('url' => 'crawler/canceled')) !!}
                {!! Form::hidden('website', $website) !!}
                {!! Form::hidden('business_id', $business_id) !!}
                {!! Form::hidden('access_key', $access_key) !!}
                {!! Form::submit('Back') !!}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </body>
</html>

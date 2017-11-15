<html>
    <head>
        <meta charset="utf-8">
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    </head>
    <body>
        <div id="snow">
            {{ Form::open(array('url' => 'login')) }}
            <h1>Login</h1>

            <!-- if there are login errors, show them here -->
            <p>
                {{ $errors->first('loginCode') }}
            </p>

            <p id="loginBox">
                {{ Form::text('loginCode') }}
            </p>

            <p id="submitButton">{{ Form::submit('GO') }}</p>
            {{ Form::close() }}
        </div>
    </body>
</html>
<html>
<head>
    <meta charset="utf-8">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
</head>
    <body>
    {{ Form::open(array('url' => 'adminLogin')) }}
    <h1>Login</h1>

    <!-- if there are login errors, show them here -->
    <p>
        {{ $errors->first('Username') }}
    </p>

    <p>
        {{ Form::text('username') }}
        {{ Form::password('password') }}
    </p>

    <p id="submitButton">{{ Form::submit('Login') }}</p>
    {{ Form::close() }}
    </body>
</html>
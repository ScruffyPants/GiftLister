<html>
    <head>
        <meta charset="utf-8">
        <link href="{{URL::asset('css/admin.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <!-- first quadrant -->
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Drawn Name</th>
                    <th>Login</th>
                    <th>Delete button</th>
                </tr>
                @foreach($infoArray as $info)
                    <tr>
                        <td>{{$info -> Name}}</td>
                        <td id="drawnName">{{$info -> DrawnName}}</td>
                        <td>{{$info -> Login}}</td>
                        <td><button onclick="deleteID({{$info->ID}})">DELETE</button></td>
                    </tr>
                @endforeach
            </table>
        </div>

        <!-- second quadrant -->
        <div>
            <p>Add User:</p>

            {{ Form::open(array('url' => 'addUser')) }}
                <p> Name: {{ Form::text('name') }} </p>
                <p> DrawnName: {{ Form::text('drawnname') }}</p>
                <p> Login: {{ Form::text('login') }}</p>

                <p id="submitButton">{{ Form::submit('Add User') }}</p>
            {{ Form::close() }}
        </div>

        <!-- third quadrant -->
        <div>
            Give all users Logins: <button onclick="giveLogins()">Give Logins</button> <br>
            Draw a name for everyone: <button onclick="drawNames()">Draw Names</button> <br>
            Clear everyone's Drawn Names: <button onclick="clearDrawn()">Clear Drawn</button> <br>
        </div>

        <!-- fourth quadrant -->
        <div>

        </div>

        <script>
            function deleteID(ID){
                $("body").load("/adminPanel/deleteUser/"+ID);
            }
            function giveLogins(){
                $("body").load("/adminPanel/giveLogins");
            }
            function drawNames(){
                $("body").load("/adminPanel/drawNames");
            }
            function clearDrawn() {
                $("body").load("/adminPanel/clearDrawn");
            }
        </script>

    </body>
</html>
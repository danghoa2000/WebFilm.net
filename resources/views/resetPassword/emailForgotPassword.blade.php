<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="background-color:#d9a300; color:aliceblue;padding:30px;font-size:250%">{{__('Notification')}} !!!</h1>
    <a href="{{route('viewReset', ['token' => $token])}}" style="font-size:25px">{{__('Click here to go to the password reset page')}}</a>
</body>
</html>

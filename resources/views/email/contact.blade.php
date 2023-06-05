<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hams</title>

</head>
<body>
     <img  width="100px" height="100px" style="margin-left: 70px" src="{{ asset('assets/user/img/logo/main_logo.png') }}" >
<p>   Name : {{$data['name'] }} </p>
<p>   Phone Number :   {{$data['phone'] }}  </p>
<p>   Email :    {{$data['email'] }} </p>
<p>   Message :   {{$data['message'] }}  </p>

</body>

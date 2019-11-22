<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>E-Trash</title>
</head>
<body>
    <br>
    <div class="container bg-black">
        <div class="jumbotron p-4 p-md-5 rounded">
            @include('layouts.navbars.navs.user') <br>
            @yield('content')
            <hr width="1000">
            @include('layouts.userfooter')
        </div>
    </div>
</body>
</html>

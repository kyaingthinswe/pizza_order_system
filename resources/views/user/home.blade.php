<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>this is home page</h1>
<h4>Role - {{\Illuminate\Support\Facades\Auth::user()->role}} <br> Name - {{Auth::user()->email}}</h4>

<form action="{{ route('logout')}}" method="POST">
    @csrf
    <input  type="submit" value="logout">
</form>
</body>
</html>

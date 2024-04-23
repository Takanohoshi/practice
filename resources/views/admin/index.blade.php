@include('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @if (session()->has('loginberhasil'))
    <div class="alert alert-success alert-dismissible fade show col-lg-10 mx-auto col-lg-5" role="alert">
        {{ session('loginberhasil') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <center>
    <div class="welcome-message">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>Selamat datang admin {{ Auth::user()->username }} !!</h1>
    </div>
    </center>
</body>
</html>
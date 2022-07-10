<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
    <style>
        body{
            background-color: #1f1e1ee1;
            color: #fff;
        }
    </style>
</head>
<body>
    @include('layout.navbar')
    
    <div class="container mt-5">
        <div class="col-md-12">
          @yield('content')
        </div>        
    </div>
</body>
@include('layout.footer')
</html>
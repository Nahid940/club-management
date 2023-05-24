<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CNBL | Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    @yield('style_link')
    <style>
        .login-page, .register-page {
          background: rgb(2,0,36);
          background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
        }
        .title{
            text-align:center;
            font-size:21px;
            color:#3744e9e6;
            font-weight:600;
        }
        .login-box{
          background-color: blue!important
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="https://cnbl.com.bd/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" href="member-login">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" href="register">Create New Account</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="card-body login-card-body">
      <div class="login-box-msg" style="align-items: center">
        <img src="{{asset('logo.avif')}}" alt="">
      </div>
        <div class='title'>
            Club Notre Damians Bangladesh
        </div>
        <p class="login-box-msg">Sign in to access your account</p>
      @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <form  method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fa fa-key" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          {{--<div class="col-8">--}}
            {{--<a href="{{route('register')}}" style="color: #ff5235;font-weight:bold;font-size:18px" class="">Create new account</a>--}}
          {{--</div>--}}
          <div class="col-12">
            <button type="submit" style="float:right" class="btn btn-success">Sign In</button> 
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>
</html>

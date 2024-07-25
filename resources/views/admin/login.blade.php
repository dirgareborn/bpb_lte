<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BPB UNM | Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition login-page">
    
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>BPB</b>UNM</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sistem Penyewaan Aset</p>
        @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @endif
      <form action="{{ url('admin/login')}}" method="post">@csrf
        <div class="input-group mb-3">
          <input @if(isset($_COOKIE["email"])) value="{{ $_COOKIE["email"] }}" @endif type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
             <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <input @if(isset($_COOKIE["password"])) value="{{ $_COOKIE["password"] }}" @endif type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
           @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input @if(isset($_COOKIE["email"])) checked="" @endif type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->


    <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('admin/js/adminlte.js?v=3.2.0') }}"></script>
</body>

</html>
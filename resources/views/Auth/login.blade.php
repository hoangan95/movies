
 <!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('auth/font/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('auth/font/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('auth/font/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <form action="{{ route('auth.login') }}" method="POST">
    @csrf
    <div class="card mb-0">
      <div class="card-body">

        <div class="text-center mb-3">
          <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
            <img src="{{ asset('admin01/assets/images/logo_icon.svg') }}" class="h-48px" alt="">
          </div>
          <h5 class="mb-0">Vui lòng đăng nhập</h5>
          <span class="d-block text-muted">Đăng nhập để mở ra thế giới</span>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
      @endif

        <div class="mb-3">
          <label class="form-label">Email</label>
          <div class="form-control-feedback form-control-feedback-start">
            <input type="text" name="email" class="form-control" placeholder="Vui lòng nhập email">
            <div class="form-control-feedback-icon">
              <i class="ph-user-circle text-muted"></i>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="form-control-feedback form-control-feedback-start">
            <input type="password" name="password" class="form-control" placeholder="•••••••••••">
            <div class="form-control-feedback-icon">
              <i class="ph-lock text-muted"></i>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
      </div>
    </div>
  </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('auth/font/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('auth/font/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('auth/font/dist/js/adminlte.min.js') }}"></script>
</body>
</html>




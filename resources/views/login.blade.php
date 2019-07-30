<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Catat Basic - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/css/sweetalert2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><img src="{{asset('/assets/icon/logobasic.png')}}" alt="logo" style="width:300px"></div>
      <div class="card-body">
        <form id="formLogin">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="index.html">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
      <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
          $("#formLogin").submit(function(event){
              event.preventDefault();
              var formData = $("#formLogin").serialize();

              $.ajaxSetup({
                headers:{'X-CSRF-TOKEN' : csrf_token}
              });
              $.ajax({
                  type : "POST",
                  url : "/doLogin",
                  dataType : "JSON",
                  data : formData,
                  success:function(data){
                    if(data.data != false){
                      swal({
                        title: "Success",
                        text: 'Login Success',
                        timer: 2500,
                        showConfirmButton: false,
                        type: 'success'
                      });

                      setTimeout(function () {
                        window.location = '/';
                      },1000)
                    }else{
                      swal({
                        title: "Error",
                        text: 'Login Failed :(, please check your email & password',
                        timer: 2500,
                        showConfirmButton: false,
                        type: 'error'
                      });
                      console.log(data);
                    }
                  },
                  error:function(error){
                    swal({
                      title: "Error",
                      text: 'Login Failed :(, please check your email & password',
                      timer: 2500,
                      showConfirmButton: false,
                      type: 'error'
                    });
                  }
              })
          })
      </script>
</body>

</html>

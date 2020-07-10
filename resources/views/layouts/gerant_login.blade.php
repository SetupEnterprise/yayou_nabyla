<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>APP YAYOU_NABILA- Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('theme-asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{asset('theme-asset/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                    @if (session('erreur'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('erreur')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenue Sur YAYOU_NABILA!</h1>
                  </div>
                  <form class="user" action="{{route('login_store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                    <input type="text" name="login" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" value="{{old('login') ?? ''}}" placeholder="Entrer votre login...">
                      {!! $errors->first('login', '<p style="color: red">:message</p>')!!}
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" value="{{old('password') ?? ''}}" placeholder="Mot de passe">
                      {!! $errors->first('password', '<p style="color: red">:message</p>')!!}
                    </div>
                    
                    <input type="submit" class="btn btn-success btn-user btn-block" value="Se Connecter">
                   
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('theme-asset/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('theme-asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('theme-asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('theme-asset/js/sb-admin-2.min.js')}}"></script>

</body>

</html>

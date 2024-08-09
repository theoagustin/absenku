<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - {{ Config::get('site.sitetitle') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="Login {{ Config::get('site.sitetitle') }} {{ Config::get('site.sitedescription') }}">

<meta name="msapplication-tap-highlight" content="no">
<link href="{{asset('assets/main.d810cf0ae7f39f28f336.css')}}" rel="stylesheet">
<link href="{{asset('assets/fontawesome/fontawesome.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<style>
.app-logo {
  height: 31px;
  width: 138px;
  background: url(images/uploads/logo-inverse.png);
}
.app-logo-inverse {
  height: 23px;
  width: 138px;
  background: url(images/uploads/logo-inverse.png);
}
</style>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
<div class="app-container">
<div class="h-100 bg-plum-plate bg-animation">
<div class="d-flex h-100 justify-content-center align-items-center pt-0"> 
<div class="mx-auto app-login-box col-md-8 mt-1 pt-0">
<div class="app-logo-inverse mx-auto mb-3" > </div>
<div class="modal-dialog w-100 mx-auto">
<div class="modal-content">
<div class="modal-body">
<div class="h5 modal-title text-center">
<h4 class="mt-2">
<div>Welcome back,</div>
<span>Silahkan masuk menggunakan Akun Anda.</span>
</h4>
</div>
@if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
<form action="{{ route('actionlogin') }}" method="post" id="formlog">
@csrf
<div class="form-row ">
<div class="col-md-12">
<div class="position-relative form-group">
<input name="username" id="username" placeholder="Username here..." type="text" class="form-control">
</div>
</div>
<div class="col-md-12">
<div class="position-relative form-group">
<input name="password" id="password" placeholder="Password here..." type="password" class="form-control">
</div>
</div>
</div>

<div class="modal-footer clearfix">

<button type="submit"  class="btn btn-primary btn-lg"> Login to Dashboard</button>


</div>
</form>
<div class="divider"></div>
</div>
</div>
</div>
<div class="text-center text-white opacity-8 mt-3">Copyright © {{ Config::get('site.sitetitle') }} {{ date('Y') }} </div>
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(e) {
    $('#google').click(function(e) {
		window.location='./google.php?act=login';
    });

});

</script>
<script type="text/javascript" src="{{asset('assets/scripts/main.d810cf0ae7f39f28f336.js')}}"></script></body>
</html>
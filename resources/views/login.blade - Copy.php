<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - {{ Config::get('site.sitetitle') }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
        	<div align="center" style="margin-top:20px;"><img class="rounded-circle" src="{{ Config::get('site.sitelogo') }}" alt="">
            </div>
            <h4 class="text-center" align="center">
            <b  style="text-transform:uppercase;">Login</b></h4>
            <hr>
            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary  col-sm-6"><i class="fa fa-lock"></i> Log In</button>
                <button type="button" onClick="beranda();" class="btn btn-success  col-sm-6"><i class="fa fa-home"></i> Home</button>
                </div>
                <hr>
                </br>
                </br>
                <p class="text-center">Belum punya akun? </br><button type="button" onClick="register();" class="btn btn-warning btn-block "><i class="fa fa-list"></i> Register Now</button></p>
            </form>
            <?php //echo password_hash("xxx", PASSWORD_DEFAULT);?>
        </div>
    </div>
    
    <script>
	function register(){
		window.location='./register';
	}
	function beranda(){
		window.location='./';
	}
	</script>
</body>
</html>
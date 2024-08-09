<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{ Config::get('site.sitetitle') }} - {{ Config::get('site.sitedescription') }}  </title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Landing page template for creative dashboard">
<meta name="keywords" content="Landing page template">

<link rel="icon" href="<?php //echo siteurl."/".img_upload_dir.'matangcode-icon.ico';?>" type="image/png" sizes="256x256">

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />

<link href="../../../../fonts.googleapis.com/css_3.css" rel="stylesheet">
<link href="../../../../fonts.googleapis.com/css_4.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="..\zadmin\themes\adminity\files\assets\pages\timeline\style.css">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/animsition.min.css') }}">

<link rel="stylesheet" href="assets/css/ionicons.min.css">

    <link rel="stylesheet" type="text/css" href="..\styles\assets\icon\themify-icons\themify-icons.css">
<link rel="stylesheet" type="text/css" href="..\styles\assets\icon\icofont\css\icofont.css">

<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<style>
.nav-link{
	color:#fff;
}
.land-home{
	background-image:url("{{ ('images/uploads/bg-images/540x330.png') }}");
	background-repeat:repeat-x;
	background-size:;
}
@media only screen and (max-width:450px){
.land-home{
	background-image:url(<?php //echo '../images/uploads/bg-images/540x256-1.png';?>);
	background-repeat:repeat;
	background-size:cover;
}	
.nav-link{
	color:#039;
}
}
</style>
</head>
<body>
<div class="wrapper animsition" data-animsition-in-class="fade-in" data-animsition-in-duration="1000" data-animsition-out-class="fade-out" data-animsition-out-duration="1000">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light navbar-default navbar-fixed-top  land-home" role="navigation">
<div class="container">
<a class="navbar-brand page-scroll" href="./#main"><img src="{{ ('images/uploads/logo-inverse.png') }}" alt="Logo" /></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
</ul>
<ul class="navbar-nav my-2 my-lg-0" style="color:white">
<li class="nav-item"><a class="nav-link page-scroll" href="./#main">Home</a></li>
<li class="nav-item"><a class="nav-link page-scroll" href="./#panduan">Panduan</a></li>
<li class="nav-item"><a class="nav-link page-scroll" href="./#syarat-ketentuan">Syarat & Ketentuan</a></li>
<li class="nav-item"><a class="nav-link page-scroll" href="/register">Pendaftaran </a></li>
<li class="nav-item"><a class="nav-link page-scroll" href="../login">Login</a></li>
</ul>
</div>
</div>
</nav>
</div>
<div class="main" id="main">
<style>
ul,li{
	padding:3px;	
}
@media only screen and (max-width:450px){
.main{
	margin-top:10%;	
}
}
</style>

            <!-- Main Section-->
            <div class="hero-section app-hero">
                <div class="container">
                    <div class="hero-content app-hero-content text-center">
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <h1 class="wow fadeInUp" data-wow-delay="0s">SaaS Absenku </h1>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">
                                    Daftarkan segera perusahaan Anda untuk mendapatkan layanan ini . <br class="hidden-xs"> Anda memegang Control atas Karyawan Anda.
                                </p>
                                <a class="btn btn-primary btn-action mt-3" data-wow-delay="0.2s" href="">Daftarkan Perusahaan Anda Sekarang</a><br>
                                <a class="btn btn-primary btn-action mt-3" data-wow-delay="0.2s" href="app-arm64-v8a-release.apk">Download Absenku_1_1.0.APK (v8a)</a><br>
                            </div>
                            <div class="col-md-12">
                                <div class="hero-image">
                                    <img class="img-fluid" src="assets\images\app_hero_1.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
<div class="hero-section app-hero land-home">
    <div class="container" >
        <div class="hero-content app-hero-content" style="margin-top:0px; padding-top:5px;">
            <div class="row justify-content-md-left">
                <div class="col-md-6">
        	<h1 class="wow fadeInUp" data-wow-delay="0s">Fitur Layanan</h1>
                 <p>
                    
                        <ul>
                        
                        <li><i class="ion-android-checkbox-outline"></i>&nbsp;1. Mendafarkan Perusahaan Anda.</li>
                        <li><i class="ion-android-checkbox-outline"></i>&nbsp;2. Mengisi data Bagian Perusahaan.</li>
                        <li><i class="ion-android-checkbox-outline"></i>&nbsp;3. Mengisi data Posisi/ Jabatan dalam perusahaan .</li>
                        <li><i class="ion-android-checkbox-outline"></i>&nbsp;4. Mengisi data Karyawan Perusahaan dan menentukan posisi/ jabatan.</li>
                        <li><i class="ion-android-checkbox-outline"></i>&nbsp;5. Absensi dapat diisi oleh Admin atau Karyawan Anda.</li>
                        </ul>
                    
                </p>
                </div>
                
                </div>
            </div>
        </div>
    </div>
    

</div>

<div class="flex-features " id="syarat-ketentuan">
<div class="container" style="margin-top:2%;">
<div class="flex-split  text-left  m-t-0 p-0">
        <div class="f-right text-justify">
          <div class="right-content wow fadeInUp" data-wow-delay="0.2s">
            <h2>Syarat dan Ketentuan</h2>
                <hr>
                <h6><span  style="font-weight:bold;">Syarat Penggunaan</span></h6>
                <p>
                	Melakukan pembayaran atas Layanan Aplikasi Absensi Karyawan sebesar Rp. 500.000 per Tahun
                </p>
                <hr>
                <h6><span  style="font-weight:bold;">Ketentuan Layanan</span></h6>
                <p>
                    
                        <ul>
                        <li><i class="ion-android-checkbox-outline"></i>1. Dengan melakukan pedaftaran artinya Anda mematuhi semua kebijakan kami tentang layanan ini.</li>
                        <li><i class="ion-android-checkbox-outline"></i>2. Anda dapat menghubungi kami jika ada kendala 24 jam selama hari kerja </li>
                        <li><i class="ion-android-checkbox-outline"></i>3. Absensi Karyawan sepenuhnya menjadi tanggung jawan Perusahaan Anda.</li>

                        </ul>
                    
                </p>
            </div>
        </div>
        
    </div>
</div>

<div class="flex-features " >
<div class="container">


    <div class="flex-split" id="panduan">
       
        <div class="f-right wow fadeInUp " data-wow-delay="0.2s">
            <div class="right-content text-justify">
                <h2>Panduan Pengguna</h2>
                
                <hr>
                <h6><span  style="font-weight:bold;">Bacalah Panduan berikut dengan seksama</span></h6>
              <p>
                    
                        <ul>
                        
                        <li>1. Pendaftaran Perusuhaan harus menggunakan Akun Google Anda/ Akun Google Perusahaan.</li>
                        <li>2. Isikan form pendaftaran Perusahaan Anda dan ikuti tahapan sampai selesai</li>
                        <li>3. Login dapat dilakukan setelah anda memiliki Akun yang diberikan oleh sistem</li>
                        <li>4. Lakukan pengisian data yang dibutuhkan Perusahaan Anda sesuai menu yang disediakan</li>
                        <li>5. Klik Tombol (+ Data Baru ) untuk menambah data baru, isikan form data kemudian simpan</li>
                        <li>6. Edit dan Hapus data dengan cara klik tombol yang disediakan pada kolom baris </li>
                        data tabel
                        <li>7. Buatlah akun untuk karyawan  Anda jika Absesi dilakukan oleh masing-masing karyawan Anda</li>
                        <li>8. Selamat menikmati layanan kami.</li>
                        </ul>
                    
                </p>
               
            </div>
        </div>
    </div>

</div>
</div>


<div class="footer">
<div class="container">
<div class="col-md-12 text-center">
 <img src="{{ ('images/uploads/logo-inverse.png') }}" alt="<?php //echo sitetitle;?> Logo" />
<ul class="footer-menu">
<li><a href="http://demo.com">Site</a></li>
<li><a href="./#">Support</a></li>
<li><a href="./#">Terms</a></li>
<li><a href="./#">Privacy</a></li>
</ul>
<div class="footer-text">
<p>
By {{ Config::get('define.author') }} &copy; <?php echo date('Y');?>. All Rights Reserved.
</p>
</div>
</div>
</div>
</div>

<a id="back-top" class="back-to-top page-scroll" href="./#main">
<i class="ion-ios-arrow-thin-up"></i>
</a>

</div>

</div>


<script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
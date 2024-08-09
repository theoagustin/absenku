<?php 
//if($_SESSION['AUTH_LOG']=='YES'){?>
<div class="app-sidebar sidebar-shadow">
          <?php //include "./../resources/views/template/part/site-brand.blade.php";?>
          <div class="app-header__menu"><span><button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"><span class="btn-icon-wrapper"><i class="fa fa-ellipsis-v fa-w-6"></i></span></button></span></div>
          <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
              <ul class="vertical-nav-menu">
            <?php if(Auth::user()->role_level==1){?>
            
                <li class="app-sidebar__heading">Menu Master</li>
                
                  <li><a href="<?php echo url('/admin');?>" class=""><i class="metismenu-icon pe-7s-home"></i>Beranda</a></li>
                    <li><a href="<?php echo url('/perusahaan-approve');?>" class=""><i class="metismenu-icon pe-7s-settings"></i>Data Perusahaan (Approve) </a></li>
                    <li><a href="<?php echo url('/perusahaan');?>" class=""><i class="metismenu-icon pe-7s-wallet"></i>Data Perusahaan</a></li>
                    
                <?php }elseif(Auth::user()->role_level==2){?>
                
                <li class="app-sidebar__heading">Menu</li>
                 <li><a href="<?php echo url('/dashboard');?>" class="<?php //if($_GET['page']=='perusahaan'){echo 'mm-active';}?>"><i class="metismenu-icon  pe-7s-home"></i>Dashboard</a></li>
                 <li><a href="<?php echo url('/perusahaan');?>" class="<?php //if($_GET['page']=='perusahaan'){echo 'mm-active';}?>"><i class="metismenu-icon  pe-7s-home"></i>Data Perusahaan</a></li>
                    
                <li ><a href="<?php echo url('/karyawan');?>" class=""><i class="metismenu-icon pe-7s-add-user"></i>Data Karyawan</a></li>
                <li><a href="<?php echo url('/akunkaryawan');?>" class=""><i class="metismenu-icon pe-7s-user"></i>Akun Karyawan</a></li>
                <li><a href="<?php echo url('/absensi-report');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Laporan Absensi</a></li>
                <li><a href="<?php echo url('/absensi-rekap');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Rekap Absen</a></li>
                <li><a href="<?php echo url('/shifts');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Shift</a></li>
                <li><a href="<?php echo url('/shift_karyawan');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Shift Karyawan</a></li>
                <li><a href="<?php echo url('/profil-perusahaan');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Profil Perusahaan</a></li>
                <li><a href="<?php echo url('/cuti-admin');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Permohonan</a></li>
                <li><a href="<?php echo url('/lembur');?>" class=""><i class="metismenu-icon pe-7s-repeat"></i>Lembur</a></li>
                
                <?php }else{?>
Karyawan
<?php }?>
                 </ul>
              
            </div>
          </div>
        </div>

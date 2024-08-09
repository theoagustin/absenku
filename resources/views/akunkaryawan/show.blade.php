@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header');
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu');
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Detail Karyawan
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
                        <form >
                           @forelse ($data as $data)

                            <table width="100%" border="0" cellpadding="0">
                            
  <tr>
    <td colspan="3"><b>Data Pribadi</b></td>
  </tr>
  <tr>
    <td width="12%">Nama Karyawan</td>
    <td width="1%">:</td>
    <td width="87%">{{ $data->nama}}</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td>@if($data->jekel =='L') Laki-Laki @else Perempuan @endif  </td>
  </tr>
  <tr>
    <td>NIK</td>
    <td>:</td>
    <td>{{ $data->nik}}</td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td>{{ $data->alamat}}</td>
  </tr>
  <tr>
    <td>Telp</td>
    <td>:</td>
    <td>{{ $data->telp}}</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>{{ $data->email}}</td>
  </tr>
  <tr>
    <td>NPWP</td>
    <td>:</td>
    <td>{{ $data->npwp}}</td>
  </tr>
  <tr>
    <td colspan="3"><b>Tempat Kerja</b></td>
  </tr>
  <tr>
    <td>Nama Perusahaan</td>
    <td>:</td>
    <td>{{ $data->nama_perusahaan}}</td>
  </tr>
  <tr>
    <td>Bagian</td>
    <td>:</td>
    <td>{{ $data->nama_bagian}}</td>
  </tr>
  <tr>
    <td>Posisi/Jabatan</td>
    <td>:</td>
    <td>{{ $data->nama_posisi}}</td>
  </tr>
  <tr>
    <td>Gaji Pokok</td>
    <td>:</td>
    <td>{{number_format($data->gaji_pokok)}}</td>
  </tr>
  <tr>
    <td>Mulai Bekerja</td>
    <td>:</td>
    <td>{{date('d-m-Y',strtotime($data->tgl_mulai_bekerja))}}</td>
  </tr>
</table>

                            
                            @empty
                            
                                  <div class="alert alert-danger">
                                      Data Karyawan tidak ditemukan.
                                  </div>
                            @endforelse
                            
                        </form> 
                    </div>
                </div>
    
   
</div>
          <div class="app-wrapper-footer">
 
 @include('../template/part/nav-bottom');
          </div>
        </div>
      </div>
    </div>
   
 @include('../template/part/nav-right');
@include('../template/footersite') 
 
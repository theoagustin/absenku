<style>
img {
  border-radius: 50%;
}
</style><div class="main-card mb-2 card" >
<div class="card-body mt-5">
<h5 class="card-title">Selamat Datang {{Auth::user()->nama}} !
</h5>
<div class="divider"></div>
<div align="center">
<a href="{{ route('absensi.index') }}" class="btn btn-sm btn-success"><i class="lnr-home" style="font-size:30px; text-align:center;"></i>
<div align="center" style="font-size:11px;">Home</div></a>
<a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary"><i class="lnr-pencil" style="font-size:30px; text-align:center;"></i>
<div align="center" style="font-size:11px;">Absen</div></a>
<a href="{{ route('cuti.index') }}" class="btn btn-sm btn-danger"><i class="lnr-calendar-full" style="font-size:30px; text-align:center;"></i>
<div style="font-size:11px;">Cuti</div></a>
<a href="{{ route('history.index') }}" class="btn btn-sm btn-warning"><i class="lnr-list" style="font-size:32px; text-align:center;"></i>
<div style="font-size:11px;">History</div></a>
<a href="{{ route('idcard.index') }}" class="btn btn-sm btn-success"><i class="lnr-license" style="font-size:30px; text-align:center;"></i>
<div>Card</div></a>
<a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger"><i class="lnr-user" style="font-size:30px; text-align:center;"></i>
<div style="font-size:11px;">Profile</div></a>
</div>
<hr>
<div class="row">
<h6 class="card-title ml-2">Profile Karyawan</h6>
<div class="col-sm-12  mt-1 p-2">
    <div class="card alert-default">
        <div class="card-body">
 
                  <?php $no=1;
				  ?>
                  @forelse ($data as $data)
                  <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:14px;">
  <tr>
    <td width="31%">Nama</td>
    <td width="1%">:</td>
    <td width="68%">{{$data->nama}}</td>
  </tr>
  <tr>
    <td>NIK </td>
    <td>:</td>
    <td>{{$data->nik}}</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td>{{$data->jekel}}</td>
  </tr>
  <tr>
    <td>Alamat Lengkap</td>
    <td>:</td>
    <td>{{$data->alamat}}</td>
  </tr>
  <tr>
    <td>Telp/ Hp</td>
    <td>:</td>
    <td>{{$data->telp}}</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>{{$data->email}}</td>
  </tr>
  <tr>
    <td>NPWP</td>
    <td>:</td>
    <td>{{$data->npwp}}</td>
  </tr>
  <tr>
    <td>Nama Perusahaan</td>
    <td>:</td>
    <td>{{$data->nama_perusahaan}}</td>
  </tr>
  <tr>
    <td>Bagian</td>
    <td>:</td>
    <td>{{$data->nama_bagian}}</td>
  </tr>
  <tr>
    <td>Posisi/ Jabatan</td>
    <td>:</td>
    <td>{{$data->nama_posisi}}</td>
  </tr>
</table>

                    @empty
                                  <div class="alert alert-danger">
                                      ID Card belum tersedia.
                                  </div>
                              @endforelse
                 
        </div>
    </div>
</div>
</div>
</div>
</div>


<script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
    

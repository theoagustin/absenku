<div class="main-card mb-3 card" >

    <div class="card-body">
    <h5 class="card-title">Selamat Datang !</h5>
        <div class="divider"></div>
        @forelse ($data as $data)
         @csrf
             <div>
              {{$data->nama}} Data Perusahaan belum Tersedia.Silahkan Klik Tombol +Data Baru untuk Registrasi Perusahaan Anda !
             </div>
         
        @empty
            <div>Data Perusahaan belum Tersedia.Silahkan Klik Tombol +Data Baru untuk Registrasi Perusahaan Anda !
            </div>
         
		@endforelse
        <div class="divider"></div>
    </div>
</div>
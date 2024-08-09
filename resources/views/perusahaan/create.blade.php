@include('../template/headersite')

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')

    <div class="app-main__inner">
        <div class="main-card mb-3 card" style="margin-top:60px;">
            <div class="card-body">
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap" async
                    defer></script>

                <title>Google Maps Laravel</title>

                <h5>Registrasi Perusahaan</h5>
                <div class="alert alert-info mt-2">
                    <p>Isikan data dibawah ini dengan benar dan lengkap, kemudian ajukan untuk proses verifikasi</p>
                </div>
                <hr>
                <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">Nama Perusahaan</label>
                        <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                            name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                            placeholder="Masukkan Nama Perusahaan">
                        @error('nama_perusahaan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5"
                            placeholder="Masukkan Alamat Perusahaan">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Nama Owner</label>
                        <input type="text" class="form-control @error('owner') is-invalid @enderror"
                            name="owner" value="{{ old('owner') }}" placeholder="Masukkan Nama Owner">
                        @error('owner')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Bidang</label>
                        <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                            name="bidang" value="{{ old('bidang') }}" placeholder="Masukkan Nama Bidang">
                        @error('bidang')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Masukkan Email" value="{{ old('email') }}" />
                        @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Telp</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp"
                            placeholder="Masukkan Nomor Telepon" value="{{ old('telp') }}" inputmode="numeric" />
                        @error('telp')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Lokasi Perusahaan</label>
                        <input type="hidden" class="form-control @error('lat') is-invalid @enderror" name="lat"
                            rows="5" placeholder="Masukkan Latitude" value="{{ old('lat') }}"
                            id="lat" />
                        <input type="hidden" class="form-control @error('lan') is-invalid @enderror" name="lan"
                            rows="5" placeholder="Masukkan Longitude" value="{{ old('lan') }}"
                            id="lan" />
                        <div id="googleMap" style="height:400px;">Maps Here</div>
                        @error('lat')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('lan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Jarak lokasi absen ke Perusahaan (dalam satuan Meter)</label>
                        <input type="number" class="form-control @error('max_jarak_absen') is-invalid @enderror" inputmode="numeric"
                            name="max_jarak_absen" placeholder="Masukkan Maksimal Jarak Lokasi Absen dengan Lokasi Perusahaan dalam satuan Meter"
                            value="{{ old('max_jarak_absen') }}" />
                        @error('max_jarak_absen')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">Ajukan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('#lat').val(position.coords.latitude);
            $('#lan').val(position.coords.longitude);
        }

        $(document).ready(function(e) {
            getLocation();
        });

        function myMap() {
            var lati = document.getElementById('lat').value;
            var langi = document.getElementById('lan').value;

            var mapProp = {
                center: new google.maps.LatLng(lati, langi),
                zoom: 15,
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lati, langi),
                map: peta,
                title: 'Lokasi Perusahaan',
                animation: google.maps.Animation.BOUNCE,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lan').value = event.latLng.lng();
            });

            google.maps.event.addListener(peta, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lan').value = event.latLng.lng();
            });
        }
    </script>

    <div class="app-wrapper-footer">
        @include('../template/part/nav-bottom')
    </div>
</div>
@include('../template/part/nav-right')
@include('../template/footersite')

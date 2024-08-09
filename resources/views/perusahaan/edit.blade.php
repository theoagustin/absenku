@include('../template/headersite')
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0">
        @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap" async defer></script>
                        <h3>Form Edit Data Perusahaan</h3>
                        <hr>
                        <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                                <input type="text"
                                    class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                    name="nama_perusahaan"
                                    value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}"
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
                                    placeholder="Masukkan Alamat Perusahaan">{{ old('alamat', $perusahaan->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Owner</label>
                                <input type="text"
                                    class="form-control @error('owner') is-invalid @enderror" name="owner"
                                    value="{{ old('owner', $perusahaan->owner) }}" placeholder="Masukkan Nama Owner">
                                @error('owner')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bidang</label>
                                <input type="text"
                                    class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                                    value="{{ old('bidang', $perusahaan->bidang) }}" placeholder="Masukkan Nama Bidang">
                                @error('bidang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Masukkan Email"
                                    value="{{ old('email', $perusahaan->email) }}" />
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Telp</label>
                                <input type="text" inputmode="numeric" class="form-control @error('telp') is-invalid @enderror"
                                    name="telp" placeholder="Masukkan Email"
                                    value="{{ old('telp', $perusahaan->telp) }}" />
                                @error('telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Lokasi Perusahaan</label>
                                <input type="hidden" class="form-control @error('lat') is-invalid @enderror"
                                    name="lat" placeholder="Masukkan Email"
                                    value="{{ old('lat', $perusahaan->latitude) }}" id="lat" />
                                <input type="hidden" class="form-control @error('lan') is-invalid @enderror"
                                    name="lan" placeholder="Masukkan Email"
                                    value="{{ old('lan', $perusahaan->langitude) }}" id="lan" />
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
                                <label class="font-weight-bold">Jarak lokasi absen ke Perusahaan (dalam satuan
                                    Meter)</label>
                                <input type="text"
                                    class="form-control @error('max_jarak_absen') is-invalid @enderror"
                                    name="max_jarak_absen"
                                    placeholder="Masukkan Maksimal Jarak Lokasi Absen dengan Lokasi Perusahaan dalam satuan Meter"
                                    value="{{ old('max_jarak_absen', $perusahaan->max_jarak_absen) }}" />
                                @error('max_jarak_absen')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <button type="button" onClick="window.history.back();"
                                class="btn btn-md btn-success">BACK</button>

                        </form>
                    </div>
                </div>
            </div>
            <script>
                function hitungJarak(posisi_1, posisi_2) {
                    var posisi_1 = new google.maps.LatLng(5.372492596250256, 95.94860724772833);
                    var posisi_2 = new google.maps.LatLng(5.372357072107898, 95.94858847226523);

                    return (google.maps.geometry.spherical.computeDistanceBetween(posisi_1, posisi_2) / 1000).toFixed(5);
                }

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

                function buatMarker(peta, posisiTitik) {
                    var marker = new google.maps.Marker({
                        position: posisiTitik,
                        map: peta,
                        draggable: true
                    });
                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        var lat = event.latLng.lat();
                        var lng = event.latLng.lng();
                        $('#lat').val(lat);
                        $('#lan').val(lng);
                    });
                    return marker;
                }

                function myMap() {
                    var gmarkers = [];
                    var lati = document.getElementById('lat').value;
                    var langi = document.getElementById('lan').value;

                    var mapProp = {
                        center: new google.maps.LatLng(lati, langi),
                        zoom: 15,
                    };
                    var peta = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                    var marker = buatMarker(peta, new google.maps.LatLng(lati, langi));
                    gmarkers.push(marker);

                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        document.getElementById('lat').value = event.latLng.lat();
                        document.getElementById('lan').value = event.latLng.lng();
                    });

                    google.maps.event.addListener(peta, 'click', function(event) {
                        for (var i = 0; i < gmarkers.length; i++) {
                            gmarkers[i].setMap(null);
                        }
                        gmarkers = [];
                        var newMarker = buatMarker(this, event.latLng);
                        gmarkers.push(newMarker);

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
    </div>
</div>
<?php //include "part/nav-right.php";
?>

@include('../template/part/nav-right')
@include('../template/footersite')

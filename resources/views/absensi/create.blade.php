@include('../template/headersite')
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">


    @include('../template/part/nav-header')
    <!--@include('../template/part/layout-setting');-->


    <div class="app-main__inner m-0 mt-5 p-1">
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <div class="main-card mb-3 card">
            <div class="card-body">

                <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap" async
                    defer></script>
                <h5 class="card-title">Selamat Datang {{ Auth::user()->nama }}
                </h5>
                <div class="divider"></div>
                <div align="center">
                    <a href="{{ route('absensi.index') }}" class="btn btn-sm btn-success"><i class="lnr-home"
                            style="font-size:30px; text-align:center;"></i>
                        <div align="center" style="font-size:11px;">Home</div>
                    </a>
                    <a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary"><i class="lnr-pencil"
                            style="font-size:30px; text-align:center;"></i>
                        <div align="center" style="font-size:11px;">Absen</div>
                    </a>
                    <a href="{{ route('cuti.index') }}" class="btn btn-sm btn-danger"><i class="lnr-calendar-full"
                            style="font-size:30px; text-align:center;"></i>
                        <div style="font-size:11px;">Cuti</div>
                    </a>
                    <a href="{{ route('history.index') }}" class="btn btn-sm btn-warning"><i class="lnr-list"
                            style="font-size:32px; text-align:center;"></i>
                        <div style="font-size:11px;">History</div>
                    </a>
                    <a href="{{ route('idcard.index') }}" class="btn btn-sm btn-success"><i class="lnr-license"
                            style="font-size:30px; text-align:center;"></i>
                        <div>Card</div>
                    </a>
                    <a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger"><i class="lnr-user"
                            style="font-size:30px; text-align:center;"></i>
                        <div style="font-size:11px;">Profile</div>
                    </a>
                </div>
                <hr>
                <div class="alert alert-danger" style="direction:none;">
                    Lokasi harus diizinkan
                    <p>Setelah lokasi diizinkan, silahkan refresh halaman ini</p>
                </div>
                <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table id="tabasen" width="100%" border="0" cellspacing="0" cellpadding="1"
                        style="display:none;">
                        <tr>
                            <td colspan="3"><strong>Jadwal Absen</strong></td>
                        </tr>
                        @forelse ($datakaryawan as $data)
                            <?php //$lat_p=number_format("$data->latitude",7);$lan_p=number_format("$data->langitude",7);
                            $lat_p = "$data->latitude";
                            $lan_p = "$data->langitude";
                            // echo $lat_p.",".$lan_p;
                            ?>

                        @empty
                        @endforelse
                        <?php $cek_masuk = '';
                        $cek_keluar = '';
                        $idabsen = '';
                        $opt = ''; ?>

                        @forelse($absensi as $cek_absen)
                            <?php $cek_masuk = "$cek_absen->jam_masuk";
                            $cek_keluar = "$cek_absen->jam_keluar";
                            $idabsen = "$cek_absen->id";
                            if ($cek_masuk == '') {
                                $opt .= '<option value="M" class="p-0">Masuk</option>';
                            } else {
                                if ($cek_keluar == '') {
                                    $opt .= '<option value="K" class="p-0">Keluar</option>';
                                }
                            }

                            ?>

                            <input type="hidden" class="form-control" name="idabsen" rows="5"
                                value="{{ $cek_absen->id }}" id="idabsen" />
                        @empty
                            <?php
                            $opt .= '<option value="M" class="p-0">Masuk</option>'; ?>
                        @endforelse
                        <tr>
                            <td width="20%">Hari</td>
                            <td width="0%">:</td>
                            <td width="80%"><?php echo date('l'); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo date('d-m-Y'); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Absen</td>
                            <td>:</td>
                            <td>
                                <select name="jenis_absen" onchange="StatusAbsen(this);" class="form-control p-0"
                                    style="height:30px;">
                                    <?php echo $opt; ?>
                                    <option value="S">Sakit</option>
                                    <option value="I">Izin</option>
                                </select>
                            </td>
                        </tr>

                        <tr id="ketas" style="display:none;">
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                            </td>
                            <td>&nbsp;</td>
                            <td><input type="hidden" class="form-control @error('lat') is-invalid @enderror"
                                    name="lat" value="{{ old('lat') }}" id="lat" />
                                <input type="hidden" class="form-control @error('lan') is-invalid @enderror"
                                    name="lan" value="{{ old('lan') }}" id="lan" />
                                <input type="hidden" class="form-control" name="id_karyawan" rows="5"
                                    value="{{ $data->id }}" id="id_karyawan" />


                                <input type="hidden" class="form-control" name="jarak" rows="5"
                                    value="{{ $data->max_jarak_absen }}" id="jarak" />
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>

                                <button type="submit" id="save" class="btn btn-md btn-primary">Absen</button>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div id="message"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Lokasi Anda Terkini</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div id="googleMap" style="height:180px;">Maps Here</div>
                            </td>
                        </tr>
                    </table>
                </form>
                <script>
                    function StatusAbsen(x) {
                        var sta = $(x).val();
                        if (sta == 'M' && sta == 'K') {
                            $('#ketas').hide();
                        } else if (sta == 'S') {

                            $('#ketas').show();
                        } else if (sta == 'I') {
                            $('#ketas').show();
                        }

                    }
                </script>
                <script>
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } else {
                            x.innerHTML = "Geolocation is not supported by this browser.";
                        }
                    }

                    function showPosition(position) {

                        if (position.coords.latitude == '') {
                            $('.alert').show();
                            $('#tabasen').hide();
                        } else {

                            $('#tabasen').show();
                            $('.alert').hide();

                            $('#lat').val(position.coords.latitude);
                            $('#lan').val(position.coords.longitude);
                            var posisi_1 = new google.maps.LatLng(<?php echo $lat_p; ?>, <?php echo $lan_p; ?>);
                            var posisi_2 = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            var jarak = hitungJarak(posisi_1, posisi_2);
                            var jarak_set_p = $('#jarak').val();
                            var jarak = (hitungJarak(posisi_1, posisi_2) * 1000);

                            if (jarak > jarak_set_p) {
                                $('#message').html(
                                    '<div class="alert alert-danger" style="direction:none;">Jarak dengan lokasi Maximal ' +
                                    jarak_set_p + ' Meter</div>');
                            }
                        }
                    }
                    $(document).ready(function(e) {

                    });
                    getLocation();

                    //Tandai Maps

                    function buatMarker(peta, posisiTitik) {
                        // membuat Marker
                        var koord = String(posisiTitik);
                        var korpo = koord.split(",");
                        var lat = korpo[0].replace('(', '');
                        var lan = korpo[1].replace(')', '');
                        $('#lat').val(lat);
                        $('#lan').val(lan);
                        var marker = new google.maps.Marker({
                            position: posisiTitik,
                            map: peta
                        });
                    }

                    function myMap() {
                        var gmarkers = [];
                        var lati = document.getElementById('lat').value;
                        var langi = document.getElementById('lan').value;

                        var mapProp = {
                            //center:new google.maps.LatLng(-1.3444144,107.2162613),
                            center: new google.maps.LatLng(lati, langi),
                            zoom: 15,
                        };

                        var peta = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lati, langi),
                            map: peta,
                            title: 'Lokasi Perusahaan',
                            animation: google.maps.Animation.BOUNCE
                        });


                    }
                </script>


                <script>
                    function hitungJarak(posisi_1, posisi_2) {
                        return (google.maps.geometry.spherical.computeDistanceBetween(posisi_1, posisi_2) / 1000).toFixed(5);
                    }
                </script>
                <div class="divider"></div>
            </div>
        </div>

        <script>
            //message with toastr
            @if (session()->has('success'))

                toastr.success('{{ session('success') }}', 'BERHASIL!');
            @elseif (session()->has('error'))

                toastr.error('{{ session('error') }}', 'GAGAL!');
            @endif
        </script>
    </div>
    <div class="app-wrapper-footer">

        @include('../template/part/nav-bottom')
    </div>
</div>

<!--@include('../template/part/nav-right');-->
@include('../template/footersite')

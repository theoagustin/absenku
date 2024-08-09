<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div class="main-card mb-3 card">
    <div class="card-body">

        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap" async
            defer></script>
        <h5 class="card-title">Selamat Datang {{ Auth::user()->nama }}
        </h5>
        <div class="divider"></div>
        <div class="alert alert-danger" style="direction:none;">
            Lokasi harus diizinkan
            <p>Setelah lokasi diizinkan, silahkan refresh halaman ini</p>
        </div>
        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table id="tabasen" width="100%" border="0" cellspacing="0" cellpadding="0" style="display:none;">
                <tr>
                    <td colspan="3"><strong>Selamat Datang</strong></td>
                </tr>
                @forelse ($data as $data)
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>:</td>
                        <td>{{ $data->nama_bagian }}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>:</td>
                        <td>{{ $data->nama_posisi }}</td>
                    </tr>
                    <?php //$lat_p=number_format("$data->latitude",7);$lan_p=number_format("$data->langitude",7);
                    $lat_p = "$data->latitude";
                    $lan_p = "$data->langitude";
                    // echo $lat_p.",".$lan_p;
                    ?>

                @empty
                @endforelse
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="3"><strong>Jadwal Absensi</strong></td>
                </tr>
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
                    <td>
                    </td>
                    <td>&nbsp;</td>
                    <td><input type="hidden" class="form-control @error('lat') is-invalid @enderror" name="lat"
                            value="{{ old('lat') }}" id="lat" />
                        <input type="hidden" class="form-control @error('lan') is-invalid @enderror" name="lan"
                            value="{{ old('lan') }}" id="lan" />
                        <input type="hidden" class="form-control" name="id_karyawan" rows="5"
                            value="{{ $data->id }}" id="id_karyawan" />


                        <input type="hidden" class="form-control" name="jarak" rows="5"
                            value="{{ $data->max_jarak_absen }}" id="jarak" />
                    </td>
                </tr>
                @foreach ($absensi as $cek_absen)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>

                            <?php $cek = "$cek_absen->id"; ?>
                            <?php if($cek==''){
		$act='new';?>
                            <button type="submit" id="save" class="btn btn-md btn-primary">Absen Masuk</button>
                            <?php }else{
		$act='edit';?>

                            <button type="submit" id="update" class="btn btn-md btn-danger">Absen Keluar</button>
                            <?php }?>
                            <input type="hidden" class="form-control" name="idabsen" rows="5"
                                value="<?php echo $cek; ?>" id="idabsen" />
                        </td>
                    </tr>
                @endforeach
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

@include('../template/headersite')
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">


    @include('../template/part/nav-header')

    <div class="app-main__inner">
        <div class="main-card mb-3 card" style="margin-top:60px;">
            <div class="card-body">
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap" async defer></script>

                <title>Google Maps Laravel</title>
                <?php
                if ("$perusahaan->approv" == '') {
                    $status = 'Pending';
                    $tsc = 'text-default';
                } elseif ("$perusahaan->approv" == 'Y') {
                    $status = 'Approve';
                    $tsc = 'text-success';

                    echo "<script>window.location='../perusahaan';</script>";
                } elseif ("$perusahaan->approv" == 'N') {
                    $status = 'Reject';
                    $tsc = 'text-danger';
                }
                ?>
                <h5>Info Pengajuan Perusahaan</h5>
                <div class="alert alert-info mt-2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="20%">Nama</td>
                            <td width="1%">:</td>
                            <td width="79%">{{ $perusahaan->nama_perusahaan }}</td>
                        </tr>
                        <tr>
                            <td>Owner </td>
                            <td>:</td>
                            <td>{{ $perusahaan->owner }}</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>:</td>
                            <td>{{ $perusahaan->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Telp </td>
                            <td>:</td>
                            <td>{{ $perusahaan->telp }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><span class="<?php echo $tsc; ?>"><?php echo $status; ?></span></td>
                        </tr>
                        <?php if("$perusahaan->approv"=="Y"){?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><button class="btn btn-md btn-success">Lanjut ke Dashboard</button></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>

                <p>Silahkan refresh halaman ini sewaktu-waktu untuk perubahan status</p>

                <hr>

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

        });
        getLocation();

        //Tandai Maps
        var markers = document.getElementsByTagName('marker');

        function clearOverlays() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].hide();
            }
        }

        function buatMarker(peta, posisiTitik) {
            // membuat Marker

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
            gmarkers.push(marker);

            function setMapOnAll(map) {
                for (var i = 0; i < gmarkers.length; i++) {
                    gmarkers[i].setMap(map);
                }
            }
            google.maps.event.addListener(peta, 'click', function(event) {
                alert(gmarkers.length);
                buatMarker(this, event.latLng);
            });

        }
    </script>

    <div class="app-wrapper-footer">

        @include('../template/part/nav-bottom')
    </div>
</div>
<?php //include "part/nav-right.php";
?>

@include('../template/part/nav-right')
@include('../template/footersite')

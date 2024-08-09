@include('../template/headersite')
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">


 @include('../template/part/nav-header')

      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=myMap"  async defer></script>

<title>Google Maps Laravel</title>

   <h3>Form Registrasi Perusahaan</h3>
   <hr>
                        <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="Masukkan Nama Perusahaan">

                                <!-- error message untuk title -->
                                @error('nama_perusahaan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="alamat" rows="5" placeholder="Masukkan Alamat Perusahaan">{{ old('alamat') }}</textarea>

                                <!-- error message untuk content -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Owner</label>
                                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="owner" value="{{ old('owner') }}" placeholder="Masukkan Nama Owner">

                                <!-- error message untuk title -->
                                @error('owner')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bidang</label>
                                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="bidang" value="{{ old('bidang') }}" placeholder="Masukkan Nama Bidang">

                                <!-- error message untuk title -->
                                @error('bidang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('content') is-invalid @enderror" name="email" rows="5" placeholder="Masukkan Email" value="{{ old('email') }}"/>

                                <!-- error message untuk content -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Telp</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" rows="5" placeholder="Masukkan Email" value="{{ old('telp') }}"/>

                                <!-- error message untuk content -->
                                @error('telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Lokasi Perusahaan</label>

                                <input type="hidden" class="form-control @error('lat') is-invalid @enderror" name="lat" rows="5" placeholder="Masukkan Email" value="{{ old('lat') }}" id="lat"/>
                                <input type="hidden" class="form-control @error('lan') is-invalid @enderror" name="lan" rows="5" placeholder="Masukkan Email" value="{{ old('lan') }}" id="lan"/>
                                <div id="googleMap" style="height:400px;">Maps Here</div>

                                <!-- error message untuk content -->
                                @error('telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jarak lokasi absen ke Perusahaan (dalam satuan Meter)</label>
                                <input type="text" class="form-control @error('max_jarak_absen') is-invalid @enderror" name="max_jarak_absen" rows="5" placeholder="Masukkan Maksimal Jarak Lokasi Absen dengan Lokasi Perusahaan dalam satuan Meter" value="{{ old('max_jarak_absen') }}"/>

                                <!-- error message untuk content -->
                                @error('telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>




                            <button type="submit" class="btn btn-md btn-primary">SUBMIT</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <button type="button" onClick="window.history.back();" class="btn btn-md btn-success">BACK</button>

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

});
 getLocation();

 //Tandai Maps
 var markers = document.getElementsByTagName('marker');

function clearOverlays() {
for (var i = 0; i < markers.length; i++ ) {
markers[i].hide();
}
}

 function buatMarker(peta, posisiTitik){
    // membuat Marker

    var marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
    });
}

function myMap() {
	var gmarkers = [];
	var lati=document.getElementById('lat').value;
	var langi=document.getElementById('lan').value;

var mapProp= {
  //center:new google.maps.LatLng(-1.3444144,107.2162613),
  center:new google.maps.LatLng(lati,langi),
  zoom:15,
};

var peta = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
      position: new google.maps.LatLng(lati,langi),
      map: peta,
	  title:'Lokasi Perusahaan',
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
      </div>
    </div>
    <?php //include "part/nav-right.php";?>

 @include('../template/part/nav-right')
@include('../template/footersite')


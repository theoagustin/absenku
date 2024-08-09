<?php $text_color[""] = "text-default";
$text_color['Y'] = "text-success";
$text_color['N'] = "text-danger";
?>
<div class="main-card mb-3 card">
  <div class="card-body">
    <h5 class="card-title">
      Dashboard
      <input type="date" id="dashboard-date" value="{{ $date }}" name="date" style="float:right;" onchange="changeDate()">
    </h5>
    <div class="divider"></div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Hadir</h5>
            <p class="card-text">{{ $hadir }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Izin</h5>
            <p class="card-text">{{ $izin }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sakit</h5>
            <p class="card-text">{{ $sakit }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total</h5>
            <p class="card-text">{{ $hadir + $izin + $sakit }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="divider"></div>
  </div>
</div>

<script>
  function changeDate() {
    var date = document.getElementById('dashboard-date').value;
    window.location.href = "{{ url('dashboard') }}?date=" + date;
  }
</script>

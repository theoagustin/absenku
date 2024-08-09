<?php $text_color[""] = "text-default";
$text_color['Y'] = "text-success";
$text_color['N'] = "text-danger";
?>
<div class="main-card mb-3 card">
  <div class="card-body">
    <h5 class="card-title">Data Perusahaan
    </h5>
    <div class="divider"></div>

    <table width="100%" id="example" class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
        <th width="8%"></th>
          <th width="3%">No</th>
          <th width="20%">Nama Perusahaan</th>
          <th width="15%">Bidang</th>
          <th width="12%">Owner</th>
          <th width="11%">Telp</th>
          <th width="11%">Email</th>
          <th width="8%">Jumlah Karyawan</th>
          <th width="8%">Status</th>


        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
				  ?>
        @forelse ($perusahaan as $data)
        <?php
              $id = "$data->id";
              ?>
        <tr id="row<?php  echo $id;?>" class="<?php  echo $text_color["$data->approv"];?>">
          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('perusahaan.destroy', $data->id) }}"
          method="POST">
          <td><a href="{{ route('perusahaan.edit', $data->id) }}"><i class="fa fa-edit fa-w-20"></i></a> || <a
            href="#"><button type="submit" class="btn btn-xs"><i
              class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
          @csrf
          @method('DELETE')
          </form>
          <td><?php  echo $no;?></td>
          <td>{{ $data->nama_perusahaan }}</td>
          <td>{{ $data->bidang }}</td>
          <td>{{ $data->owner }}</td>
          <td>{{ $data->telp }}</td>
          <td>{{ $data->email }}</td>
          <td>{{ $data->karyawans_count}}</td>
          <td>

          <?php  if (Auth::user()->role_level == 1) {?>
          <select id="approv" name="approv" class="form-control p-0 konfirm" style="height:30px;">

            <option value="{{ $data->id }}*" <?php    if ("$data->approv" == "") {
        echo "selected";
      }?>></option>
            <option value="{{ $data->id }}*Y" <?php    if ("$data->approv" == "Y") {
        echo "selected";
      }?>>Approve</option>
            <option value="{{ $data->id }}*N" <?php    if ("$data->approv" == "N") {
        echo "selected";
      }?>>Reject</option>
          </select>
          <?php  } else {?>
          <?php    if ("$data->approv" == "") {
        echo '<div class="alert alert-warning p-0 m-0"> Pending </div>';
      } elseif ("$data->approv" == "N") {
        echo '<div class="alert alert-danger p-0 m-0"> Rejected </div>';
      } elseif ("$data->approv" == "Y") {
        echo '<div class="alert alert-success p-0 m-0"> Approve </div>';
      }?>
          <?php  }?>

        </tr>
        <?php  $no++;?>
    @empty
    <div class="alert alert-danger"></div>
  @endforelse
      </tbody>

    </table>

    <div class="divider"></div>
  </div>
</div>

<script>
  $(document).ready(function (e) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.konfirm').on('change', function (e) {
      e.preventDefault();
      var approve = this.value;
      var textclass;

      var ndata = approve.split('*');
      var url = "{{ route('ajaxRequest.post') }}";
      var approv = ndata[1];
      var idp = ndata[0];
      if (approv == '') {
        textclass = 'text-warning';
      } else if (approv == 'N') {
        textclass = 'text-danger';
      } else if (approv == 'Y') {
        textclass = 'text-success';
      }
      $('#row' + idp).removeAttr('class');
      $.ajax({
        url: "{{ route('ajaxRequest.post') }}",
        type: "POST",
        data: { approv: approv, idp: idp },
        success: function (data) {
          $('#row' + idp).attr('class', textclass);
          //alert(data.success);

        }
      });
    });
  });

</script>
<script>
  //message with toastr
  @if(session()->has('success'))

    toastr.success('{{ session('success') }}', 'BERHASIL!');

  @elseif(session()->has('error'))

    toastr.error('{{ session('error') }}', 'GAGAL!');

  @endif
</script>

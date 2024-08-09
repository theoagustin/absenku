<?php $text_color[''] = 'text-default';
$text_color['Y'] = 'text-success';
$text_color['N'] = 'text-danger';
?>
<div class="main-card mb-3 card">
    <div class="card-body">
        @forelse($perusahaan as $data)
            <?php
            $approve = "$data->approv";
            if ($approve == '') {
                $status = 'Pending';
                $tsc = 'text-default';
                echo "<script>window.location='perusahaan/$data->id';</script>";
            } elseif ($approve == 'Y') {
                $status = 'Approve';
                $tsc = 'text-success';
            } elseif ($approve == 'N') {
                $status = 'Reject';
                $tsc = 'text-danger';

                echo "<script>window.location='../perusahaan/$data->id';</script>";
            }
            $idperusahaan = "$data->id";
            ?>

            <h5>Detail Perusahaan</h5>
            <div class="alert alert-info mt-2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="1%">:</td>
                        <td width="79%">{{ $data->nama_perusahaan }}</td>
                    </tr>
                    <tr>
                        <td>Owner </td>
                        <td>:</td>
                        <td>{{ $data->owner }}</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>:</td>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Telp </td>
                        <td>:</td>
                        <td>{{ $data->telp }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><span class="<?php echo $tsc; ?>"><?php echo $status; ?></span></td>
                    </tr>
                    <?php if("$data->approv"=="Y"){?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        @empty
        @endforelse
        <p>Silahkan refresh halaman ini sewaktu-waktu untuk perubahan status</p>
        <hr>
        <?php if($approve=='Y'){?>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="alert alert-danger panel p-3 rounded">
                    <h5>Data Bagian</h5>
                    <form action="{{ route('perusahaan.saveBagian') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table width="100%" id="bagian" class="table table-hover table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th width="88%">Bagian</th>
                                    <th width="10%">Act</th>

                                </tr>

                                <tr>
                                    <th width="2%">&nbsp;</th>
                                    <th width="88%">
                                        <input type="text" name="nama_bagian" class="form-control m-0"
                                            style="height:35px;" />
                                        <input type="hidden" name="id_perusahaan" class="form-control m-0"
                                            style="height:35px;" value="<?php echo $idperusahaan; ?>" />
                                    </th>
                                    <th width="10%"><button type="submit" class="btn btn-sm btn-success"><i
                                                class="fa fa-save"></i></button></th>
                    </form>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        ?>
                        @forelse ($bagian as $data)
                            <?php
                            $id = "$data->id"; ?>
                            <tr>

                                <td class="p-0"><?php echo $no; ?></td>
                                <td class="p-0">{{ $data->nama_bagian }}</td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('bagian.destroy', $data->id) }}" method="POST">
                                    <td><a href="#"><button type="submit" class="btn btn-xs"><i
                                                    class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                            <?php $no++; ?>
                        @empty
                            <div class="alert alert-danger">
                                Data Bagian belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>

                    </table>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="alert alert-success p-3 rounded">
                    <h5>Data Posisi</h5>
                    <form action="{{ route('perusahaan.savePosisi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table width="100%" id="bagian" class="table table-hover table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bagian</th>
                                    <th>Posisi</th>
                                    <th>Act</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>
                                        <select name="id_bagian" id="id_bagian" class="form-control">
                                            <option value="" selected>Pilih bagian</option>
                                            @foreach ($bagian as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_bagian }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_bagian')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </th>
                                    <th>
                                        <input type="text" name="nama_posisi" class="form-control"
                                            style="height:35px;" />

                                        @error('nama_posisi')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        @error('id_perusahaan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <input type="hidden" name="id_perusahaan" class="form-control m-0"
                                            style="height:35px;" value="<?php echo $idperusahaan; ?>" />
                                    </th>
                                    <th>
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </th>
                                </tr>
                    </form>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        ?>
                        @forelse ($posisi as $data)
                            <?php
                            $id = "$data->id"; ?>
                            <tr>

                                <td><?php echo $no; ?></td>
                                <td>{{ $data->nama_bagian }}</td>
                                <td>{{ $data->nama_posisi }}</td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('posisi.destroy', $data->id) }}" method="POST">
                                    <td><a href="#"><button type="submit" class="btn btn-xs"><i
                                                    class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                            <?php $no++; ?>
                        @empty
                            <div class="alert alert-danger">
                                Data Bagian belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>

                    </table>
                </div>
            </div>

        </div>
        <hr>
        <?php }?>

    </div>
</div>

<script>
    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.konfirm').on('change', function(e) {
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
                data: {
                    approv: approv,
                    idp: idp
                },
                success: function(data) {
                    $('#row' + idp).attr('class', textclass);
                    //alert(data.success);

                }
            });
        });
    });
</script>
<script>
    //message with toastr
    @if (session()->has('success'))

        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif (session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>

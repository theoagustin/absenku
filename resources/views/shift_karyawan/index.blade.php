@include('../template/headersite')

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0 ">
        @include('../template/part/nav-menu')

        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Shift Karyawan

                        </h5>
                        <div class="divider"></div>

                        <div class="row">
                            <div class="col-4">
                                <form method="GET" action="{{ route('shift_karyawan.index') }}">
                                    <div class="form-group">
                                        <label for="filter_bagian">Filter by Bagian</label>
                                        <select name="filter_bagian" id="filter_bagian" class="form-control">
                                            <option value="">-- Select Bagian --</option>
                                            @foreach($bagians as $bagian)
                                                <option value="{{ $bagian->id }}" {{ request('filter_bagian') == $bagian->id ? 'selected' : '' }}>
                                                    {{ $bagian->nama_bagian }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                                </form>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Shift</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shiftKaryawans as $shiftKaryawan)
                                    <tr id="row{{ $shiftKaryawan->id }}">
                                        <td>{{ $shiftKaryawan->karyawan->nama }}</td>
                                        <td>
                                            <form id="form-{{ $shiftKaryawan->id }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <select name="id_shift" class="form-control shift-select"
                                                        data-id="{{ $shiftKaryawan->id_karyawan }}" required>
                                                        @foreach($shifts as $shift)
                                                            <option value="{{ $shift->id }}" {{ $shift->id == $shiftKaryawan->shift->id ? 'selected' : '' }}>
                                                                {{ $shift->nama_shift }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="app-wrapper-footer">
                @include('../template/part/nav-bottom')
            </div>
        </div>
    </div>
</div>

@include('../template/footersite')

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Event listener for shift dropdown change
        $('.shift-select').on('change', function () {
            var shiftId = $(this).val();
            var karyawanId = $(this).data('id');
            $.ajax({
                url: '{{ route('shift_karyawan.update', '') }}/' + karyawanId,
                type: 'PUT',
                data: { id_shift: shiftId },
                success: function (data) {
                    alert('Shift updated successfully!');
                },
                error: function (xhr) {
                    alert('Failed to update shift.');
                }
            });
        });
    });


</script>
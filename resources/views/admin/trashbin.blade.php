<!-- resources/views/trashbin/mobil.blade.php -->

@extends('admin.layout')

@section('content')
    <div class="container">
        <h3>Trash Bin Mobil</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Mobil</th>
                    <th>Plat Nomor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashbinDataMobil as $data)
                    <tr>
                        <td>{{ $data->jenis_mobil }}</td>
                        <td>{{ $data->plat_nomor }}</td>
                        <td>
                            <a href="{{ route('mobil.restore', $data->id_mobil) }}" type="button" class="btn btn-success">Restore</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $data->id_mobil }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusModal{{ $data->id_mobil }}" tabindex="-1"
                                aria-labelledby="hapusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('mobil.delete', $data->id_mobil) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Trash Bin Karyawan</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Alamat Karyawan</th>
                    <th>No. HP Karyawan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashbinDataKaryawan as $data)
                    <tr>
                        <td>{{ $data->nama_karyawan }}</td>
                        <td>{{ $data->alamat_karyawan }}</td>
                        <td>{{ $data->no_hp_karyawan }}</td>
                        <td>
                            <a href="{{ route('karyawan.restore', $data->id_karyawan) }}" type="button" class="btn btn-success">Restore</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $data->id_karyawan }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusModal{{ $data->id_karyawan }}" tabindex="-1"
                                aria-labelledby="hapusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('karyawan.delete', $data->id_karyawan) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Trash Bin Customer</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Customer</th>
                    <th>Alamat Customer</th>
                    <th>No. HP Customer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashbinDataCustomer as $data)
                    <tr>
                        <td>{{ $data->customer }}</td>
                        <td>{{ $data->alamat_customer }}</td>
                        <td>{{ $data->no_hp_cust }}</td>
                        <td>
                            <a href="{{ route('customer.restore', $data->id_customer) }}" type="button" class="btn btn-success">Restore</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $data->id_customer }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusModal{{ $data->id_customer }}" tabindex="-1"
                                aria-labelledby="hapusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('customer.delete', $data->id_customer) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

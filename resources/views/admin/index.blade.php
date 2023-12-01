@extends('admin.layout')

@section('content')
<div class="container mt-3">
    <h1>Data Rental</h1>
            <div class="mb-3 mt-3">
                <form action="{{ route('admin.index') }}" method="GET" class="form-inline justify-content-end">
                    @csrf
                    <input class="form-control mb-1 mt-1" type="search" placeholder="Cari transaksi..." aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
    <a href="{{ route('admin.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

    @if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
    @endif

    @if ($errors = Session::get('error')) 
    <div class="alert alert-danger">
        {{ $errors }}
    </div>
    @endif


    <table class="table table-hover mt-2">
        <thead>
            <tr>
                        <th>ID Rental</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Alamat Customer</th>
                        <th>No HP Customer</th>
                        <th>Jenis Mobil</th>
                        <th>Plat Nomor</th>
                        <th>Nama Karyawan</th>
                        <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                            <td>{{ $data->id_rental }}</td>
                            <td>{{ $data->tanggal_transaksi }}</td>
                            <td>{{ $data->customer }}</td>
                            <td>{{ $data->alamat_customer }}</td>
                            <td>{{ $data->no_hp_cust }}</td>
                            <td>{{ $data->jenis_mobil }}</td>
                            <td>{{ $data->plat_nomor }}</td>
                            <td>{{ $data->nama_karyawan }}</td>
                            
                <td>
                    <a href="{{ route('admin.edit', $data->id_rental) }}" type="button"
                        class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#hapusModal{{ $data->id_rental }}">
                        Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_rental }}" tabindex="-1"
                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.delete', $data->id_rental) }}">
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

<!-- resources/views/admin/karyawan.blade.php -->

@extends('admin.layout')

@section('content')
    <div class="container mt-3">
        <h1>Data Karyawan</h1>
        <div class="mb-3 mt-3">
            <form action="{{ route('karyawan.karyawan') }}" method="GET" class="form-inline justify-content-end">
                <input class="form-control mb-1 mt-1" type="search" placeholder="Cari karyawan..." aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <a href="{{ route('karyawan.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
        @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <!-- <th>ID Karyawan</th> -->
                    <th>Nama Karyawan</th>
                    <th>Alamat Karyawan</th>
                    <th>No. HP Karyawan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataskaryawan as $data)
                    <tr>
                        <!-- <td>{{ $data->id_karyawan }}</td> -->
                        <td>{{ $data->nama_karyawan }}</td>
                        <td>{{ $data->alamat_karyawan }}</td>
                        <td>{{ $data->no_hp_karyawan }}</td>
                        <td>
                            <a href="{{ route('karyawan.edit', $data->id_karyawan) }}" type="button"
                                class="btn btn-warning rounded-3">Ubah</a>
                            <a  href="{{ route('karyawan.softDelete', $data->id_karyawan) }}" type="button" 
                                class="btn btn-dark rounded-3">Hapus S</a>
                            <!-- Button trigger modal -->
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
    </div>
@endsection

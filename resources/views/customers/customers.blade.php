<!-- resources/views/admin/customer.blade.php -->

@extends('admin.layout')

@section('content')
    <div class="container mt-3">
        <h1>Data Customer</h1>
        <div class="mb-3 mt-3">
            <form action="{{ route('customers.customers') }}" method="GET" class="form-inline justify-content-end">
                <input class="form-control mb-1 mt-1" type="search" placeholder="Cari customer..." aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>


        <a href="{{ route('customer.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
        @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <!-- <th>ID Customer</th> -->
                    <th>Nama Customer</th>
                    <th>Alamat Customer</th>
                    <th>No. HP Customer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataCustomer as $data)
                    <tr>
                        <td>{{ $data->customer }}</td>
                        <td>{{ $data->alamat_customer }}</td>
                        <td>{{ $data->no_hp_cust }}</td>
                        <td>
                            <a href="{{ route('customer.edit', $data->id_customer) }}" type="button"
                                class="btn btn-warning rounded-3">Ubah</a>
                            <a  href="{{ route('customer.softDelete', $data->id_customer) }}" type="button" 
                                class="btn btn-dark rounded-3">Hapus S</a>
                            <!-- Button trigger modal -->
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

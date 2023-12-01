@extends('admin.layout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Tambah Karyawan</h5>
        <form method="post" action="{{ route('karyawan.store') }}">
            @csrf
            <!-- <div class="mb-3">
                <label for="id_karyawan" class="form-label">ID Karyawan</label>
                <input type="text" class="form-control" id="id_karyawan" name="id_karyawan">
            </div> -->
            <div class="mb-3">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan">
            </div>
            <div class="mb-3">
                <label for="alamat_karyawan" class="form-label">Alamat Karyawan</label>
                <input type="text" class="form-control" id="alamat_karyawan" name="alamat_karyawan">
            </div>
            <!-- Sesuaikan nama kolom pada form -->
            <div class="mb-3">
                <label for="no_hp_karyawan" class="form-label">No. HP Karyawan</label>
                <input type="text" class="form-control" id="no_hp_karyawan" name="no_hp_karyawan">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop

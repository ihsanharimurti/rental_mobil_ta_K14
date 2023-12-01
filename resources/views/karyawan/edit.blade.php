@extends('admin.layout')

@section('content')

<h4 class="mt-5">Edit Data Karyawan</h4>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<form method="POST" action="{{ route('admin.update', $data->id_karyawan) }}">
    @csrf
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id_karyawan" value="{{ $data->id_karyawan }}" readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama_karyawan" value="{{ $data->nama_karyawan }}">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat_karyawan" value="{{ $data->alamat_karyawan }}">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No. HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp_karyawan" value="{{ $data->no_hp_karyawan }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

@endsection

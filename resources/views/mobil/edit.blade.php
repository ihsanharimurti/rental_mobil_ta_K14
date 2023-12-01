@extends('admin.layout')

@section('content')

<h4 class="mt-5">Edit Data Mobil</h4>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<form method="POST" action="{{ route('mobil.update', $data->id_mobil) }}">
    @csrf
    <div class="mb-3">
        <label for="id_mobil" class="form-label">ID Mobil</label>
        <input type="text" class="form-control" id="id_mobil" name="id_mobil" value="{{ $data->id_mobil }}"readonly>
    </div>
    <div class="mb-3">
        <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
        <input type="text" class="form-control" id="jenis_mobil" name="jenis_mobil" value="{{ $data->jenis_mobil }}">
    </div>
    <div class="mb-3">
        <label for="plat_nomor" class="form-label">Plat Nomor</label>
        <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="{{ $data->plat_nomor }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

@endsection

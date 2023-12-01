@extends('admin.layout')

@section('content')

<h4 class="mt-5">Edit Data Customer</h4>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<form method="POST" action="{{ route('admin.update', $data->id_customer) }}">
    @csrf
    <div class="mb-3">
        <label for="id" class="form-label">id</label>
        <input type="text" class="form-control" id="nama" name="id_customer" value="{{ $data->id_customer }}"readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="customer" value="{{ $data->customer }}">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat_customer" value="{{ $data->alamat_customer }}">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No. HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp_cust" value="{{ $data->no_hp_cust }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

@endsection

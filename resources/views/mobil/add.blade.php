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
        <h5 class="card-title fw-bolder mb-3">Tambah Mobil</h5>
        <form method="post" action="{{ route('mobil.store') }}">
            @csrf
            <!-- <div class="mb-3">
                <label for="id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="id_mobil" name="id_mobil">
            </div> -->
            <div class="mb-3">
                <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
                <input type="text" class="form-control" id="jenis_mobil" name="jenis_mobil">
            </div>
            <div class="mb-3">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor">
            </div>
            <!-- Sesuaikan nama kolom pada form -->

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop

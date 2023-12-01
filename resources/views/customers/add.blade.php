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
        <h5 class="card-title fw-bolder mb-3">Tambah Customer</h5>
        <form method="post" action="{{ route('customer.store') }}">
            @csrf
            <div class="mb-3">
                <label for="customer" class="form-label">Nama Customer</label>
                <input type="text" class="form-control" id="customer" name="customer">
            </div>
            <div class="mb-3">
                <label for="alamat_customer" class="form-label">Alamat Customer</label>
                <input type="text" class="form-control" id="alamat_customer" name="alamat_customer">
            </div>
            <div class="mb-3">
                <label for="no_hp_cust" class="form-label">No. HP Customer</label>
                <input type="text" class="form-control" id="no_hp_cust" name="no_hp_cust">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop

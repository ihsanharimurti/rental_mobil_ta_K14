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
        <h5 class="card-title fw-bolder mb-3">Tambah Pesanan</h5>
        <form method="post" action="{{ route('admin.store') }}">
            @csrf
            <!-- Dropdown for selecting mobil -->
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Pilih Mobil</label>
                <select class="form-select" id="mobil_id" name="mobil_id">
                    @foreach($mobilData as $mobil)
                        <option value="{{ $mobil->id_mobil }}">{{ $mobil->jenis_mobil }} - {{ $mobil->plat_nomor }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown for selecting karyawan -->
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
                <select class="form-select" id="karyawan_id" name="karyawan_id">
                    @foreach($karyawanData as $karyawan)
                        <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama_karyawan }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Dropdown for selecting customer -->
            <div class="mb-3">
                <label for="customer_id" class="form-label">Pilih Customer</label>
                 <select class="form-select" id="customer_id" name="customer_id">
                 @foreach($customerData as $customer)
                         <option value="{{ $customer->id_customer }}">{{ $customer->customer }} - {{ $customer->alamat_customer }}</option>
                 @endforeach
             </select>
            </div>
            
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop

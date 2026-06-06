@extends('layouts.admin')
@section('title', isset($car) ? 'Edit Mobil' : 'Tambah Mobil')
@section('header', isset($car) ? 'Edit Data Mobil' : 'Tambah Mobil Baru')

@section('content')
<div class="card card-primary card-outline">
    <form action="{{ isset($car) ? route('admin.cars.update', $car->id) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($car)) @method('PUT') @endif

        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nama Mobil</label>
                    <input type="text" name="name" class="form-control" value="{{ $car->name ?? old('name') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Brand / Merek</label>
                    <input type="text" name="brand" class="form-control" value="{{ $car->brand ?? old('brand') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Tahun Pembuatan</label>
                    <input type="number" name="year" class="form-control" value="{{ $car->year ?? old('year') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Harga Sewa Per Hari (Rp)</label>
                    <input type="number" name="price_per_day" class="form-control" value="{{ $car->price_per_day ?? old('price_per_day') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Status Armada</label>
                    <select name="status" class="form-control">
                        <option value="Tersedia" {{ (isset($car) && $car->status == 'Tersedia') ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dipakai" {{ (isset($car) && $car->status == 'Dipakai') ? 'selected' : '' }}>Dipakai</option>
                        <option value="Maintenance" {{ (isset($car) && $car->status == 'Maintenance') ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Foto Mobil</label>
                    <input type="file" name="image" class="form-control-file">
                    @if(isset($car) && $car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" width="120" class="mt-2 img-thumbnail">
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('admin.cars.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@endsection

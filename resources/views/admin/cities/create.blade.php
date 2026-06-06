@extends('layouts.admin')
@section('title', isset($city) ? 'Edit Kota' : 'Tambah Kota')
@section('header', isset($city) ? 'Edit Data Kota' : 'Tambah Kota Baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <form action="{{ isset($city) ? route('admin.cities.update', $city->id) : route('admin.cities.store') }}" method="POST">
                @csrf
                @if(isset($city))
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kota / Kabupaten</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $city->name ?? '') }}" placeholder="Contoh: Surabaya" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Provinsi</label>
                        <input type="text" name="province" class="form-control" value="{{ old('province', $city->province ?? '') }}" placeholder="Contoh: Jawa Timur" required>
                        @error('province') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Kota</button>
                    <a href="{{ route('admin.cities.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

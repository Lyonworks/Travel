@extends('layouts.admin')
@section('title', isset($driver) ? 'Edit Driver' : 'Tambah Driver')
@section('header', isset($driver) ? 'Edit Data Driver' : 'Tambah Driver Baru')

@section('content')
<div class="card card-primary card-outline">
    <form action="{{ isset($driver) ? route('admin.drivers.update', $driver->id) : route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($driver)) @method('PUT') @endif
        <div class="card-body">
            <div class="form-group">
                <label>Nama Lengkap Sopir</label>
                <input type="text" name="name" class="form-control" value="{{ $driver->name ?? old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" class="form-control" value="{{ $driver->phone ?? old('phone') }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Tersedia" {{ (isset($driver) && $driver->status == 'Tersedia') ? 'selected' : '' }}>Tersedia</option>
                    <option value="Bertugas" {{ (isset($driver) && $driver->status == 'Bertugas') ? 'selected' : '' }}>Bertugas</option>
                    <option value="Off" {{ (isset($driver) && $driver->status == 'Off') ? 'selected' : '' }}>Off</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Profil Driver</label>
                <input type="file" name="photo" class="form-control-file">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan Driver</button>
            <a href="{{ route('admin.drivers.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@endsection

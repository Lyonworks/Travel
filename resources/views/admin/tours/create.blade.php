@extends('layouts.admin')
@section('title', isset($tour) ? 'Edit Paket' : 'Tambah Paket')
@section('header', isset($tour) ? 'Edit Paket Liburan' : 'Buat Paket Wisata Baru')

@section('content')
<div class="card card-primary card-outline">
    <form action="{{ isset($tour) ? route('admin.tours.update', $tour->id) : route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($tour)) @method('PUT') @endif
        <div class="card-body">
            <div class="form-group">
                <label>Judul Paket Wisata</label>
                <input type="text" name="title" class="form-control" value="{{ $tour->title ?? old('title') }}" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Destinasi / Wilayah Target</label>
                    <input type="text" name="destination" class="form-control" value="{{ $tour->destination ?? old('destination') }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Durasi Paket (Hari)</label>
                    <input type="number" name="duration" class="form-control" value="{{ $tour->duration ?? old('duration') }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Harga Per Pack / Orang (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ $tour->price ?? old('price') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>Deskripsi & Fasilitas Tour</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $tour->description ?? old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Foto Banner Utama (Thumbnail)</label>
                <input type="file" name="thumbnail" class="form-control-file">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Publish Paket Wisata</button>
            <a href="{{ route('admin.tours.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')
@section('title', isset($route) ? 'Edit Rute' : 'Tambah Rute')
@section('header', isset($route) ? 'Edit Data Rute' : 'Tambah Rute Baru')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <form action="{{ isset($route) ? route('admin.routes.update', $route->id) : route('admin.routes.store') }}" method="POST">
                @csrf
                @if(isset($route))
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="form-group">
                        <label>Titik Keberangkatan (Kota Asal)</label>
                        <select name="origin_city_id" class="form-control" required>
                            <option value="">-- Pilih Kota Asal --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (isset($route) && $route->origin_city_id == $city->id) ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->province }})
                                </option>
                            @endforeach
                        </select>
                        @error('origin_city_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="text-center my-3 text-muted">
                        <i class="fas fa-arrow-down fa-2x"></i>
                    </div>

                    <div class="form-group">
                        <label>Titik Kedatangan (Kota Tujuan)</label>
                        <select name="destination_city_id" class="form-control" required>
                            <option value="">-- Pilih Kota Tujuan --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (isset($route) && $route->destination_city_id == $city->id) ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->province }})
                                </option>
                            @endforeach
                        </select>
                        @error('destination_city_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Rute</button>
                    <a href="{{ route('admin.routes.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi</h3>
            </div>
            <div class="card-body text-muted small">
                <p>Data rute ini akan digunakan sebagai master relasi saat pembuatan <strong>Jadwal Travel</strong>.</p>
                <p>Pastikan Kota Asal dan Kota Tujuan <strong>tidak boleh sama</strong>. Validasi ini sebaiknya Anda atur juga di dalam Controller (misal menggunakan rule <code>different:origin_city_id</code>).</p>
            </div>
        </div>
    </div>
</div>
@endsection

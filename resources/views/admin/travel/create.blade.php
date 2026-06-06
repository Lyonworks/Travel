@extends('layouts.admin')
@section('title', isset($travel) ? 'Edit Jadwal' : 'Tambah Jadwal')
@section('header', isset($travel) ? 'Edit Jadwal Perjalanan' : 'Tambah Jadwal Baru')

@section('content')
<div class="card card-primary card-outline">
    <form action="{{ isset($travel) ? route('admin.travel.update', $travel->id) : route('admin.travel.store') }}" method="POST">
        @csrf
        @if(isset($travel))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group">
                <label>Pilih Rute Perjalanan</label>
                <select name="route_id" class="form-control" required>
                    <option value="">-- Pilih Rute Kota --</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}" {{ (isset($travel) && $travel->route_id == $route->id) ? 'selected' : '' }}>
                            {{ $route->originCity->name }} ({{ $route->originCity->province }}) → {{ $route->destinationCity->name }} ({{ $route->destinationCity->province }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Waktu Keberangkatan</label>
                    <input type="datetime-local" name="departure_time" class="form-control" value="{{ isset($travel) ? $travel->departure_time->format('Y-m-d\TH:i') : old('departure_time') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Estimasi Waktu Tiba</label>
                    <input type="datetime-local" name="arrival_time" class="form-control" value="{{ isset($travel) ? $travel->arrival_time->format('Y-m-d\TH:i') : old('arrival_time') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Harga Tiket (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ $travel->price ?? old('price') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Total Kapasitas Kursi</label>
                    <input type="number" name="capacity" class="form-control" value="{{ $travel->capacity ?? old('capacity') }}" required>
                </div>

                {{-- Field 'Sisa Kursi' hanya muncul saat Admin sedang mengedit jadwal (bukan saat tambah baru) --}}
                @if(isset($travel))
                <div class="form-group col-md-4">
                    <label>Sisa Kursi Tersedia</label>
                    <input type="number" name="available_seat" class="form-control" value="{{ $travel->available_seat }}" required>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label>Status Operasional</label>
                <select name="status" class="form-control">
                    <option value="active" {{ (isset($travel) && $travel->status == 'active') ? 'selected' : '' }}>Active (Tersedia)</option>
                    <option value="full" {{ (isset($travel) && $travel->status == 'full') ? 'selected' : '' }}>Full (Penuh)</option>
                    <option value="cancelled" {{ (isset($travel) && $travel->status == 'cancelled') ? 'selected' : '' }}>Cancelled (Batal)</option>
                </select>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Jadwal</button>
            <a href="{{ route('admin.travel.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@endsection

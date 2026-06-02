@extends('layouts.frontend')
@section('title', 'Cari Jadwal Travel')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 p-md-5">
                <h3 class="fw-bold text-center mb-4">Mau pergi kemana hari ini?</h3>
                <form action="{{ route('travel.search') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Kota Asal</label>
                            <select name="origin_city" class="form-select form-select-lg" required>
                                <option value="">Pilih Asal...</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Kota Tujuan</label>
                            <select name="destination_city" class="form-select form-select-lg" required>
                                <option value="">Pilih Tujuan...</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Tanggal Berangkat</label>
                            <input type="date" name="departure_date" class="form-control form-control-lg" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Jumlah Penumpang</label>
                            <input type="number" name="passengers" class="form-control form-control-lg" min="1" value="1" required>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100 btn-lg">Cari Tiket Travel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

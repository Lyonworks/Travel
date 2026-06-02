@extends('layouts.frontend')
@section('title', 'Detail Sewa ' . $car->name)

@section('content')
<div class="container mt-5">
    <div class="row g-4">
        <!-- Kolom Info Mobil -->
        <div class="col-lg-7">
            <div class="card p-3">
                <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=600' }}" class="img-fluid rounded-4 mb-4" alt="{{ $car->name }}" style="width: 100%; max-height: 400px; object-fit: cover;">
                <h3 class="fw-bold mb-1">{{ $car->name }}</h3>
                <p class="text-muted mb-4">{{ $car->brand }} • Tahun {{ $car->year }} • Plat {{ $car->plate_number }}</p>

                <h5 class="fw-bold mb-3">Fasilitas & Ketentuan</h5>
                <div class="row g-2 mb-2">
                    <div class="col-6"><i class="fas fa-snowflake text-primary me-2"></i> AC Dingin</div>
                    <div class="col-6"><i class="fas fa-gas-pump text-primary me-2"></i> BBM (Sesuai Opsi)</div>
                    <div class="col-6"><i class="fas fa-couch text-primary me-2"></i> Bersih & Nyaman</div>
                    <div class="col-6"><i class="fas fa-tools text-primary me-2"></i> Asuransi Perjalanan</div>
                </div>
            </div>
        </div>

        <!-- Kolom Form Booking -->
        <div class="col-lg-5">
            <div class="card p-4">
                <h4 class="fw-bold mb-4">Formulir Penyewaan</h4>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('rental.book', $car->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Lokasi Penjemputan</label>
                        <input type="text" name="pickup_location" class="form-control" placeholder="Contoh: Bandara / Alamat Rumah" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Tanggal & Jam Ambil</label>
                        <input type="datetime-local" name="pickup_date" class="form-control" min="{{ date('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Tanggal & Jam Kembali</label>
                        <input type="datetime-local" name="return_date" class="form-control" min="{{ date('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Pilihan Sopir / Driver</label>
                        <select name="driver_id" class="form-select">
                            <option value="">Lepas Kunci (Tanpa Sopir)</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">Dengan Driver: {{ $driver->name }} (+ Biaya Layanan)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Tarif Dasar Armada</span>
                        <span class="fw-bold text-dark fs-5">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}<small class="text-muted font-weight-normal">/hari</small></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

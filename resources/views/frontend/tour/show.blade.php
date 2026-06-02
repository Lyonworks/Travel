@extends('layouts.frontend')
@section('title', $package->title)

@section('content')
<div class="container mt-5">
    <div class="row g-4">
        <!-- Detail Konten Wisata -->
        <div class="col-lg-8">
            <div class="card p-4 mb-4">
                <img src="{{ $package->thumbnail ? asset('storage/' . $package->thumbnail) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600' }}" class="img-fluid rounded-4 mb-4" alt="{{ $package->title }}" style="width: 100%; max-height: 450px; object-fit: cover;">

                <h2 class="fw-bold text-dark mb-2">{{ $package->title }}</h2>
                <p class="text-muted mb-4"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Destinasi: {{ $package->destination }} | <i class="fas fa-clock me-2 text-primary ms-3"></i> Durasi: {{ $package->duration }} Hari</p>

                <h5 class="fw-bold mb-3">Deskripsi Paket Wisata</h5>
                <p class="text-muted style-text" style="line-height: 1.8;">{{ $package->description }}</p>
            </div>

            <!-- Susunan Rencana Perjalanan (Itinerary) -->
            <h4 class="fw-bold text-dark mb-3">Rencana Perjalanan (Itinerary)</h4>
            <div class="position-relative border-start border-2 border-primary ps-4 ms-2">
                @forelse($package->itineraries as $itinerary)
                    <div class="mb-4 position-relative">
                        <!-- Bullet Icon -->
                        <div class="position-absolute bg-primary rounded-circle" style="width: 12px; height: 12px; left: -31px; top: 6px;"></div>
                        <h6 class="fw-bold text-primary mb-1">HARI KE-{{ $itinerary->day }} : {{ $itinerary->title }}</h6>
                        <p class="text-muted small mb-0">{{ $itinerary->description }}</p>
                    </div>
                @empty
                    <p class="text-muted small">Itinerary belum di-input oleh admin.</p>
                @endforelse
            </div>
        </div>

        <!-- Sticky Form Booking Side -->
        <div class="col-lg-4">
            <div class="card p-4 position-sticky" style="top: 100px;">
                <h5 class="fw-bold mb-4">Pesan Slot Liburan</h5>
                <form action="{{ route('tour.book', $package->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Tanggal Keberangkatan</label>
                        <input type="date" name="booking_date" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Jumlah Peserta (Orang)</label>
                        <input type="number" name="participants" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Harga paket dasar</span>
                        <span class="fw-bold text-primary fs-5">Rp {{ number_format($package->price, 0, ',', '.') }}<small class="text-muted font-weight-normal">/pax</small></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

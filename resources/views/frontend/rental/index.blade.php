@extends('layouts.frontend')
@section('title', 'Sewa & Carter Mobil')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Pilihan Armada Carter Mobil</h2>
        <p class="text-muted">Pilih kendaraan terbaik yang sesuai dengan kebutuhan perjalanan Anda</p>
    </div>

    <div class="row">
        @if($cars->isEmpty())
            <div class="col-12 text-center p-5">
                <i class="fas fa-car-crash fa-3x text-muted mb-3"></i>
                <h5>Maaf, tidak ada mobil yang tersedia saat ini.</h5>
            </div>
        @else
            @foreach($cars as $car)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 overflow-hidden">
                    <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=600' }}" class="card-img-top" alt="{{ $car->name }}" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start">{{ $car->brand }}</span>
                        <h5 class="card-title fw-bold text-dark mb-1">{{ $car->name }}</h5>
                        <p class="text-muted small mb-3"><i class="fas fa-calendar-alt me-1"></i> Tahun {{ $car->year }}</p>

                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block small">Per hari</small>
                                <span class="fw-bold text-warning fs-5">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('rental.show', $car->id) }}" class="btn btn-sm btn-primary">Sewa Mobil</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

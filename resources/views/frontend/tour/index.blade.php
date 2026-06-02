@extends('layouts.frontend')
@section('title', 'Paket Wisata')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Paket Wisata Populer</h2>
        <p class="text-muted">Eksplorasi keindahan destinasi impian Anda dengan layanan bintang lima</p>
    </div>

    <div class="row">
        @foreach($packages as $package)
        <div class="col-md-4 mb-4">
            <div class="card h-100 overflow-hidden">
                <img src="{{ $package->thumbnail ? asset('storage/' . $package->thumbnail) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600' }}" class="card-img-top" alt="{{ $package->title }}" style="height: 220px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary"><i class="fas fa-map-marker-alt me-1"></i> {{ $package->destination }}</span>
                        <span class="text-muted small fw-bold"><i class="fas fa-clock me-1"></i> {{ $package->duration }} Hari</span>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-3">{{ $package->title }}</h5>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block small">Mulai dari</small>
                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($package->price, 0, ',', '.') }}</span><small class="text-muted">/pax</small>
                        </div>
                        <a href="{{ route('tour.show', $package->slug) }}" class="btn btn-sm btn-primary">Detail Paket</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $packages->links() }}
    </div>
</div>
@endsection

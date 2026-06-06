@extends('layouts.frontend')
@section('title', 'Beranda')

@section('content')
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Temukan Perjalanan Terbaikmu</h1>
        <p class="lead mb-5 opacity-75">Layanan travel antar kota, carter mobil eksklusif, hingga eksplorasi pesona wisata Nusantara dalam satu ketukan.</p>
    </div>
</section>

<div class="container position-relative" style="z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <div class="card-body">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-bus-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Travel Antar Kota</h5>
                    <p class="text-muted small">Jadwal pasti, armada nyaman, dan harga transparan.</p>
                    <a href="{{ route('travel.index') }}" class="btn btn-sm btn-primary mt-2">Cari Tiket</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <div class="card-body">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-car-side fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Carter Mobil</h5>
                    <p class="text-muted small">Sewa mobil lepas kunci atau dengan driver profesional.</p>
                    <a href="{{ route('carter.index') }}" class="btn btn-sm btn-primary mt-2">Pilih Mobil</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <div class="card-body">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-map-marked-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Paket Wisata</h5>
                    <p class="text-muted small">Eksplorasi destinasi memukau dengan itinerary lengkap.</p>
                    <a href="{{ route('tour.index') }}" class="btn btn-sm btn-primary mt-2">Lihat Paket</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

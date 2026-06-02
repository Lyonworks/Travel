@extends('layouts.frontend')
@section('title', 'Hasil Pencarian Travel')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Hasil Pencarian</h4>
            <p class="text-muted mb-0">Menampilkan jadwal untuk tanggal {{ \Carbon\Carbon::parse($request->departure_date)->format('d M Y') }}</p>
        </div>
        <a href="{{ route('travel.index') }}" class="btn btn-outline-secondary btn-sm">Ubah Pencarian</a>
    </div>

    @if($schedules->isEmpty())
        <div class="alert alert-warning text-center p-5 rounded-4">
            <i class="fas fa-search fa-3x mb-3 text-muted"></i>
            <h5>Maaf, jadwal tidak ditemukan.</h5>
            <p class="mb-0">Coba ubah tanggal atau rute pencarian Anda.</p>
        </div>
    @else
        <div class="row">
            @foreach($schedules as $schedule)
            <div class="col-12 mb-3">
                <div class="card p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center border-end">
                            <h4 class="fw-bold text-primary mb-0">{{ $schedule->departure_time->format('H:i') }}</h4>
                            <p class="text-muted small mb-0">{{ $schedule->route->originCity->name }}</p>
                            <i class="fas fa-arrow-down my-1 text-muted"></i>
                            <h4 class="fw-bold text-primary mb-0">{{ $schedule->arrival_time->format('H:i') }}</h4>
                            <p class="text-muted small mb-0">{{ $schedule->route->destinationCity->name }}</p>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0 px-md-4">
                            <span class="badge bg-success bg-opacity-10 text-success mb-2"><i class="fas fa-check-circle"></i> Kursi Tersedia: {{ $schedule->available_seat }}</span>
                            <h5 class="fw-bold">Nusantara Executive</h5>
                            <ul class="text-muted small mb-0 ps-3">
                                <li>AC / Recleaning Seat</li>
                                <li>Free Snack & Air Mineral</li>
                                <li>Estimasi perjalanan {{ $schedule->departure_time->diffInHours($schedule->arrival_time) }} jam</li>
                            </ul>
                        </div>
                        <div class="col-md-3 mt-3 mt-md-0 text-md-end text-center">
                            <p class="text-muted small mb-1">Harga per pax</p>
                            <h3 class="fw-bold text-warning mb-3">Rp {{ number_format($schedule->price, 0, ',', '.') }}</h3>

                            <form action="{{ route('travel.book', $schedule->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="seat_number" value="Random Seat">
                                <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

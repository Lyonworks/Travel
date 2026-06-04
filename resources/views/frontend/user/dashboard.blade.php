@extends('layouts.frontend')
@section('title', 'Dashboard Saya')

@section('content')
<div class="container mt-5">
    <div class="row g-4">

        <!-- 1. SIDEBAR MENU USER -->
        <div class="col-lg-3">
            <div class="card p-3 border-0 shadow-sm sticky-top" style="top: 100px; border-radius: 16px;">
                <div class="text-center pb-3 border-bottom mb-3">
                    <div class="mb-2">
                        @if(auth()->user()->avatar)
                            <img src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle border border-primary p-1" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                        @endif
                    </div>
                    <h6 class="fw-bold text-dark mb-0">{{ auth()->user()->name }}</h6>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>

                <!-- Nav Pills Links -->
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-start mb-2 py-2.5" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab">
                        <i class="fas fa-th-large me-2"></i> Ringkasan
                    </button>
                    <button class="nav-link text-start mb-2 py-2.5" id="v-pills-booking-tab" data-bs-toggle="pill" data-bs-target="#v-pills-booking" type="button" role="tab">
                        <i class="fas fa-ticket-alt me-2"></i> Booking Aktif
                    </button>
                    <button class="nav-link text-start mb-2 py-2.5" id="v-pills-history-tab" data-bs-toggle="pill" data-bs-target="#v-pills-history" type="button" role="tab">
                        <i class="fas fa-history me-2"></i> Riwayat Perjalanan
                    </button>
                    <button class="nav-link text-start mb-2 py-2.5" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab">
                        <i class="fas fa-wallet me-2"></i> Pembayaran
                    </button>
                    <button class="nav-link text-start mb-2 py-2.5" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                        <i class="fas fa-user-cog me-2"></i> Profil Saya
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. KONTEN PANEL DASHBOARD -->
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">

                <!-- TAB A: RINGKASAN -->
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                    <div class="card p-4 mb-4 border-0 shadow-sm">
                        <h4 class="fw-bold mb-1">Halo, {{ auth()->user()->name }}! 👋</h4>
                        <p class="text-muted mb-0">Selamat datang kembali. Cek status perjalanan aktif atau kelola pembayaranmu di sini.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card p-3 border-0 bg-white shadow-sm">
                                <span class="text-muted small d-block mb-1">Total Pesanan</span>
                                <h3 class="fw-bold mb-0 text-dark">
                                    {{ auth()->user()->travelBookings()->count() + auth()->user()->carBookings()->count() + auth()->user()->tourBookings()->count() }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 border-0 bg-white shadow-sm">
                                <span class="text-muted small d-block mb-1">Sewa Mobil</span>
                                <h3 class="fw-bold mb-0 text-primary">{{ auth()->user()->carBookings()->count() }} <small class="fs-6 text-muted">Armada</small></h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 border-0 bg-white shadow-sm">
                                <span class="text-muted small d-block mb-1">Paket Liburan</span>
                                <h3 class="fw-bold mb-0 text-success">{{ auth()->user()->tourBookings()->count() }} <small class="fs-6 text-muted">Destinasi</small></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB B: BOOKING AKTIF -->
                <div class="tab-pane fade" id="v-pills-booking" role="tabpanel">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-ticket-alt text-primary me-2"></i> Tiket & Booking Saya</h5>

                    <!-- Accordion Sub-Layanan -->
                    <div class="accordion" id="bookingAccordion">

                        <!-- 1. Travel Antar Kota -->
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTravel">
                                    <i class="fas fa-bus text-primary me-2"></i> Travel Antar Kota
                                </button>
                            </h2>
                            <div id="collapseTravel" class="accordion-collapse collapse show" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body bg-light bg-opacity-50">
                                    @forelse(auth()->user()->travelBookings->where('status', 'pending') as $tb)
                                        <div class="card p-3 mb-2 border-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge bg-warning text-dark mb-2">{{ $tb->booking_code }}</span>
                                                    <h6 class="fw-bold mb-1">{{ $tb->schedule->route->originCity->name }} → {{ $tb->schedule->route->destinationCity->name }}</h6>
                                                    <small class="text-muted"><i class="far fa-clock me-1"></i> {{ $tb->schedule->departure_time->format('d M Y, H:i') }}</small>
                                                </div>
                                                <div class="text-end">
                                                    <span class="fw-bold text-primary d-block">Rp {{ number_format($tb->total_price, 0, ',', '.') }}</span>
                                                    <span class="badge bg-danger bg-opacity-10 text-danger mt-1">{{ strtoupper($tb->payment_status) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted small text-center my-3">Tidak ada jadwal travel aktif.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- 2. Carter Mobil -->
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCar">
                                    <i class="fas fa-car text-primary me-2"></i> Carter Mobil
                                </button>
                            </h2>
                            <div id="collapseCar" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body bg-light bg-opacity-50">
                                    @forelse(auth()->user()->carBookings->where('status', 'pending') as $cb)
                                        <div class="card p-3 mb-2 border-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $cb->car->name }} ({{ $cb->car->brand }})</h6>
                                                    <small class="text-muted d-block"><i class="fas fa-map-marker-alt me-1"></i> {{ $cb->pickup_location }}</small>
                                                    <small class="text-muted"><i class="far fa-calendar me-1"></i> {{ $cb->pickup_date->format('d M Y') }}</small>
                                                </div>
                                                <span class="fw-bold text-dark">Rp {{ number_format($cb->total_price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted small text-center my-3">Tidak ada reservasi sewa mobil aktif.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- 3. Paket Wisata -->
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTour">
                                    <i class="fas fa-map-marked-alt text-primary me-2"></i> Paket Wisata
                                </button>
                            </h2>
                            <div id="collapseTour" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body bg-light bg-opacity-50">
                                    @forelse(auth()->user()->tourBookings->where('status', 'pending') as $tob)
                                        <div class="card p-3 mb-2 border-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $tob->tourPackage->title }}</h6>
                                                    <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $tob->participants }} Peserta • Keberangkatan {{ $tob->booking_date->format('d M Y') }}</small>
                                                </div>
                                                <span class="fw-bold text-success">Rp {{ number_format($tob->total_price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted small text-center my-3">Tidak ada paket wisata aktif.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TAB C: RIWAYAT BOOKING -->
                <div class="tab-pane fade" id="v-pills-history" role="tabpanel">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-history text-primary me-2"></i> Riwayat Transaksi Selesai</h5>
                    <div class="card p-4 border-0 shadow-sm text-center">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0 small">Belum ada perjalanan masa lalu yang diselesaikan atau dibatalkan.</p>
                    </div>
                </div>

                <!-- TAB D: PEMBAYARAN -->
                <div class="tab-pane fade" id="v-pills-payment" role="tabpanel">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-wallet text-primary me-2"></i> Tagihan Belum Dibayar</h5>
                    <div class="card p-4 border-0 shadow-sm">
                        <div class="text-center py-3">
                            <i class="fas fa-file-invoice-dollar fa-3x text-muted mb-3"></i>
                            <h6 class="fw-bold text-dark">Semua Beres!</h6>
                            <p class="text-muted small mb-0">Tidak ada invoice atau tagihan tertunda yang memerlukan konfirmasi Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- TAB E: PROFIL SAYA -->
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-user-cog text-primary me-2"></i> Informasi & Edit Profil</h5>
                    <div class="card p-4 border-0 shadow-sm">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row align-items-center mb-4">
                                <div class="col-md-3 text-center">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle img-thumbnail mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-light text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 100px; height: 100px;">
                                            <i class="fas fa-camera fa-2x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <label class="form-label text-muted small fw-bold">Ganti Foto Profil</label>
                                    <input type="file" name="avatar" class="form-control" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG, JPEG. Maks 2MB.</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Status Akun</label>
                                <input type="text" class="form-control text-primary fw-bold bg-light" value="{{ auth()->user()->google_id ? 'Terkoneksi dengan Google' : 'Akun Regular' }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

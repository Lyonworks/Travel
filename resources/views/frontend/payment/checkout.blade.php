@extends('layouts.frontend')
@section('title', 'Metode Pembayaran Checkout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4 text-center mb-4">
                <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                <h3 class="fw-bold">Satu Langkah Lagi!</h3>
                <p class="text-muted mb-0">Pesanan Anda telah berhasil dibuat. Selesaikan pembayaran Anda sebelum batas waktu berakhir.</p>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-4">Pilih Metode Pembayaran</h5>

                <form action="#" method="POST">
                    @csrf
                    <!-- Opsi Transfer Bank -->
                    <div class="form-check p-3 border rounded-3 mb-3 d-flex align-items-center">
                        <input class="form-check-input ms-1 me-3" type="radio" name="payment_method" id="bank" value="Transfer Bank" checked>
                        <label class="form-check-label w-100" for="bank">
                            <span class="fw-bold d-block">Transfer Bank Manual (Verifikasi Manual)</span>
                            <small class="text-muted">Kirim dana melalui Bank BCA, Mandiri, atau BRI</small>
                        </label>
                    </div>

                    <!-- Opsi Digital E-Wallet -->
                    <div class="form-check p-3 border rounded-3 mb-4 d-flex align-items-center">
                        <input class="form-check-input ms-1 me-3" type="radio" name="payment_method" id="ewallet" value="E-Wallet">
                        <label class="form-check-label w-100" for="ewallet">
                            <span class="fw-bold d-block">E-Wallet Instan (GOPAY / OVO / DANA)</span>
                            <small class="text-muted">Bayar instan menggunakan kode QRIS terpadu</small>
                        </label>
                    </div>

                    <div class="border-top pt-4 text-center">
                        <p class="text-muted small">Informasi detail invoice dan kode tiket elektronik (E-Ticket) akan diterbitkan otomatis pada halaman Dashboard Riwayat Booking Anda segera setelah status pembayaran diverifikasi oleh Tim Keuangan.</p>
                        <button type="button" onclick="alert('Pemesanan Berhasil Disimpan! Silakan cek menu Riwayat Pesanan pada Dashboard Anda.')" class="btn btn-primary btn-lg w-100 mt-2">Konfirmasi Pilihan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

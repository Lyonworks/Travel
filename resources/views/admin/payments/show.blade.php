@extends('layouts.admin')
@section('title', 'Detail Invoice')
@section('header', 'Verifikasi Keuangan Pelanggan')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-info">
            <div class="card-header"><h3 class="card-title">Ringkasan Invoice</h3></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td>Tipe Pesanan:</td><td><strong>{{ class_basename($payment->booking_type) }}</strong></td></tr>
                    <tr><td>Total Tagihan:</td><td><h4>Rp {{ number_format($payment->amount, 0, ',', '.') }}</h4></td></tr>
                    <tr><td>Metode Bayar:</td><td><span class="badge badge-secondary">{{ $payment->payment_method }}</span></td></tr>
                    <tr><td>ID Transaksi:</td><td><code>{{ $payment->transaction_id ?? 'N/A' }}</code></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-warning">
            <div class="card-header"><h3 class="card-title">Ubah Status / Aksi</h3></div>
            <form action="{{ route('admin.payments.updateStatus', $payment->id) }}" method="POST">
                @csrf @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label>Pilih Keputusan Kebijakan Keuangan</label>
                        <select name="status" class="form-control">
                            <option value="Menunggu" {{ $payment->status == 'Menunggu' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="Dibayar" {{ $payment->status == 'Dibayar' ? 'selected' : '' }}>Konfirmasi: Sudah Dibayar (Valid)</option>
                            <option value="Gagal" {{ $payment->status == 'Gagal' ? 'selected' : '' }}>Tolak: Bukti Transfer Salah / Gagal</option>
                            <option value="Refund" {{ $payment->status == 'Refund' ? 'selected' : '' }}>Kembalikan Uang (Refund)</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-success">Update Status Finansial</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 

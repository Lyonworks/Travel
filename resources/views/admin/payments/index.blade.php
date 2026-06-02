@extends('layouts.admin')
@section('title', 'Konfirmasi Pembayaran')
@section('header', 'Daftar Log Invoice & Pembayaran')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID Trx</th>
                    <th>Jenis Booking</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td><code>#PAY-{{ $payment->id }}</code></td>
                    <td><span class="badge badge-dark">{{ class_basename($payment->booking_type) }}</span></td>
                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>
                        <span class="badge badge-{{ $payment->status == 'Dibayar' ? 'success' : ($payment->status == 'Menunggu' ? 'warning' : 'danger') }}">
                            {{ $payment->status }}
                        </span>
                    </td>
                    <td><a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-xs btn-outline-primary">Buka Lembar Verifikasi</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $activities['total_users'] ?? 0 }}</h3>
                <p>Total Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $activities['total_cities'] ?? 0 }}</h3>
                <p>Data Kota</p>
            </div>
            <div class="icon">
                <i class="fas fa-city"></i>
            </div>
            <a href="{{ route('admin.cities.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $activities['total_routes'] ?? 0 }}</h3>
                <p>Rute Perjalanan</p>
            </div>
            <div class="icon">
                <i class="fas fa-route"></i>
            </div>
            <a href="{{ route('admin.routes.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $activities['total_cars'] ?? 0 }}</h3>
                <p>Armada Mobil</p>
            </div>
            <div class="icon">
                <i class="fas fa-car"></i>
            </div>
            <a href="{{ route('admin.cars.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $activities['total_tours'] ?? 0 }}</h3>
                <p>Paket Wisata</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <a href="{{ route('admin.tours.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Transaksi</h3>
                <p>Laporan Pembayaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}!</h3>
            </div>
            <div class="card-body">
                <p>Gunakan menu di sebelah kiri untuk mengelola master data layanan, melihat transaksi pelanggan, dan mengatur pengguna sistem.</p>
            </div>
        </div>
    </div>
</div>
@endsection

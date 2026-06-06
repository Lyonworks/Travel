@extends('layouts.admin')
@section('title', 'Data Mobil')
@section('header', 'Manajemen Armada Mobil')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Mobil</h3>
        <div class="card-tools">
            <a href="{{ route('admin.cars.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Mobil</a>
        </div>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-2">{{ session('success') }}</div>
        @endif
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama / Brand</th>
                    <th>Harga / Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="" class="img-circle img-size-32 mr-2" style="object-fit: cover; width:45px; height:45px;">
                        @else
                            <span class="badge badge-secondary">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $car->name }}</strong> <br><small class="text-muted">{{ $car->brand }} ({{ $car->year }})</small></td>
                    <td>Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $car->status == 'Tersedia' ? 'success' : ($car->status == 'Dipakai' ? 'warning' : 'danger') }}">
                            {{ $car->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

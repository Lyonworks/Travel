@extends('layouts.admin')
@section('title', 'Jadwal Travel')
@section('header', 'Jadwal Keberangkatan Travel')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Rute & Jadwal</h3>
        <div class="card-tools"><a href="{{ route('admin.travel.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Jadwal</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rute (Asal → Tujuan)</th>
                    <th>Jam Berangkat</th>
                    <th>Estimasi Tiba</th>
                    <th>Harga</th>
                    <th>Sisa Kursi / Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td><strong>{{ $schedule->route->originCity->name }}</strong> → <strong>{{ $schedule->route->destinationCity->name }}</strong></td>
                    <td>{{ $schedule->departure_time->format('d M Y, H:i') }}</td>
                    <td>{{ $schedule->arrival_time->format('d M Y, H:i') }}</td>
                    <td>Rp {{ number_format($schedule->price, 0, ',', '.') }}</td>
                    <td>{{ $schedule->available_seat }} / {{ $schedule->capacity }} Kursi</td>
                    <td><span class="badge badge-{{ $schedule->status == 'active' ? 'success' : 'danger' }}">{{ strtoupper($schedule->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.travel.edit', $schedule->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.travel.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal?')">
                            @csrf @method('DELETE') <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

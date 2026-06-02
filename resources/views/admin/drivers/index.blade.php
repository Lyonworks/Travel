@extends('layouts.admin')
@section('title', 'Data Driver')
@section('header', 'Manajemen Driver')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Sopir / Driver</h3>
        <div class="card-tools"><a href="{{ route('admin.drivers.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Driver</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drivers as $driver)
                <tr>
                    <td><img src="{{ $driver->photo ? asset('storage/'.$driver->photo) : 'https://via.placeholder.com/150' }}" class="img-circle" style="width:40px; height:40px; object-fit:cover;"></td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td><span class="badge badge-{{ $driver->status == 'Tersedia' ? 'success' : ($driver->status == 'Bertugas' ? 'info' : 'secondary') }}">{{ $driver->status }}</span></td>
                    <td>
                        <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus sopir ini?')">
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

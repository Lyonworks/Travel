@extends('layouts.admin')
@section('title', 'Data Rute')
@section('header', 'Manajemen Rute Perjalanan')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Rute Travel</h3>
        <div class="card-tools">
            <a href="{{ route('admin.routes.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah Rute
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($routes as $index => $route)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $route->originCity->name }}</strong>
                        <br><small class="text-muted">{{ $route->originCity->province ?? 'Provinsi' }}</small>
                    </td>
                    <td>
                        <strong>{{ $route->destinationCity->name }}</strong>
                        <br><small class="text-muted">{{ $route->destinationCity->province ?? 'Provinsi' }}</small>
                    </td>
                    <td>
                        <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rute ini? Menghapus rute dapat mempengaruhi jadwal travel yang terhubung.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data rute yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

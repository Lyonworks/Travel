@extends('layouts.admin')
@section('title', 'Data Kota')
@section('header', 'Master Data Kota')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Kota Tujuan & Asal</h3>
        <div class="card-tools">
            <a href="{{ route('admin.cities.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah Kota
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
                    <th>Nama Kota / Kabupaten</th>
                    <th>Provinsi</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $index => $city)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $city->name }}</strong></td>
                    <td><span class="badge badge-info">{{ $city->province ?? 'Tidak didefinisikan' }}</span></td>
                    <td>
                        <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data kota ini? Ini mungkin akan mempengaruhi data rute yang terhubung.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data kota yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

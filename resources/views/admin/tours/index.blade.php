@extends('layouts.admin')
@section('title', 'Paket Wisata')
@section('header', 'Manajemen Paket Destinasi Wisata')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Tour Wisata</h3>
        <div class="card-tools"><a href="{{ route('admin.tours.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Paket</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Nama Paket</th>
                    <th>Lokasi Utama</th>
                    <th>Durasi Hari</th>
                    <th>Harga Base / Orang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $tour)
                <tr>
                    <td><img src="{{ $tour->thumbnail ? asset('storage/'.$tour->thumbnail) : 'https://via.placeholder.com/150' }}" style="width:60px; border-radius:4px;"></td>
                    <td><strong>{{ $tour->title }}</strong></td>
                    <td>{{ $tour->destination }}</td>
                    <td>{{ $tour->duration }} Hari</td>
                    <td>Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus paket ini?')">
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

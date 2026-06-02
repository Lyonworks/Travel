@extends('layouts.admin')
@section('title', 'Ubah Role User')
@section('header', 'Modifikasi Akses Sistem')

@section('content')
<div class="card card-warning card-outline">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <p>Mengubah Role Pengguna untuk Akun: <strong>{{ $user->name }}</strong> (<code>{{ $user->email }}</code>)</p>
            <div class="form-group">
                <label>Pilih Tingkatan Hak Akses Baru</label>
                <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ strtoupper($role->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Perbarui Otoritas Akses</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@endsection

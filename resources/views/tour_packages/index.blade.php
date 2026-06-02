<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Paket Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="p-8">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-800 mb-8">Manajemen Paket Wisata</h1>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-slate-700">Tambah Paket Baru</h2>
            <form action="{{ route('tour-packages.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Paket</label>
                    <input type="text" name="nama_paket" required class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#5050F4] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari" required class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#5050F4] focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-600 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga_paket" required class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#5050F4] focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-600 mb-1">Deskripsi</label>
                    <textarea name="deskripsi_singkat" rows="3" required class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#5050F4] focus:outline-none"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-[#5050F4] hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors">
                        Simpan Paket
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-sm border-b border-slate-200">
                        <th class="p-4 font-semibold">Nama Paket</th>
                        <th class="p-4 font-semibold">Deskripsi</th>
                        <th class="p-4 font-semibold">Durasi</th>
                        <th class="p-4 font-semibold">Harga</th>
                        <th class="p-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700">
                    @foreach($packages as $p)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $p->nama_paket }}</td>
                        <td class="p-4">{{ Str::limit($p->deskripsi_singkat, 50) }}</td>
                        <td class="p-4">{{ $p->durasi_hari }} Hari</td>
                        <td class="p-4">Rp {{ number_format($p->harga_paket, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <form action="{{ route('tour-packages.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

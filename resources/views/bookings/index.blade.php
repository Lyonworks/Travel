<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Booking Travel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="p-6 md:p-12">

    <div class="max-w-7xl mx-auto">
        <header class="mb-10">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard Transaksi Booking</h1>
            <p class="text-slate-500 mt-1">Kelola data pemesanan travel antar kota, carter mobil, dan paket wisata secara terpusat.</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm h-fit">
                <h2 class="text-lg font-bold text-slate-800 mb-4">Buat Booking Baru</h2>

                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Pilih Pelanggan</label>
                        <select name="user_id" required class="w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none">
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Tipe Layanan</label>
                        <select id="tipe_layanan" name="tipe_layanan" required onchange="toggleLayananOptions()" class="w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none">
                            <option value="">-- Pilih Layanan --</option>
                            <option value="travel">Travel Antar Kota</option>
                            <option value="car">Carter Mobil + Driver</option>
                            <option value="tour">Paket Wisata</option>
                        </select>
                    </div>

                    <div id="wrapper_layanan" class="hidden">
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Pilih Detail Paket/Rute</label>

                        <select id="select_travel" name="layanan_id" class="layanan-select w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none hidden">
                            @foreach($travels as $t)
                                <option value="{{ $t->id }}">{{ $t->asal }} ke {{ $t->tujuan }} (Jam {{ $t->jam_berangkat }})</option>
                            @endforeach
                        </select>

                        <select id="select_car" name="layanan_id" class="layanan-select w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none hidden" disabled>
                            @foreach($cars as $c)
                                <option value="{{ $c->id }}">{{ $c->nama_mobil }} [{{ $c->plat_nomor }}]</option>
                            @endforeach
                        </select>

                        <select id="select_tour" name="layanan_id" class="layanan-select w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none hidden" disabled>
                            @foreach($tours as $to)
                                <option value="{{ $to->id }}">{{ $to->nama_paket }} ({{ $to->durasi_hari }} Hari)</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_layanan" required class="w-full border border-slate-200 rounded-lg p-2.5 bg-slate-50 text-sm focus:ring-2 focus:ring-[#5050F4] focus:bg-white focus:outline-none">
                    </div>

                    <button type="submit" class="w-full bg-[#5050F4] hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors text-sm mt-2">
                        Konfirmasi Booking
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden h-fit">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">Riwayat & Status Reservasi</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-100">
                                <th class="p-4 font-semibold">ID</th>
                                <th class="p-4 font-semibold">Pelanggan</th>
                                <th class="p-4 font-semibold">Layanan / Item</th>
                                <th class="p-4 font-semibold">Tanggal</th>
                                <th class="p-4 font-semibold">Total Biaya</th>
                                <th class="p-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                            @forelse($bookings as $b)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 text-slate-400">#{{ $b->id }}</td>
                                <td class="p-4 font-medium text-slate-900">{{ $b->user->name }}</td>
                                <td class="p-4">
                                    <span class="inline-block text-xs font-medium px-2 py-0.5 rounded mb-1
                                        {{ $b->layanan_type === 'App\Models\TravelRoute' ? 'bg-blue-50 text-blue-600' : '' }}
                                        {{ $b->layanan_type === 'App\Models\CarRental' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                        {{ $b->layanan_type === 'App\Models\TourPackage' ? 'bg-purple-50 text-purple-600' : '' }}
                                    ">
                                        {{ basename($b->layanan_type) }}
                                    </span>
                                    <div class="text-xs text-slate-500">
                                        @if($b->layanan_type === 'App\Models\TravelRoute')
                                            {{ $b->layanan->asal }} → {{ $b->layanan->tujuan }}
                                        @elseif($b->layanan_type === 'App\Models\CarRental')
                                            {{ $b->layanan->nama_mobil }}
                                        @else
                                            {{ $b->layanan->nama_paket ?? 'Paket Terhapus' }}
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600 text-xs">{{ \Carbon\Carbon::parse($b->tanggal_layanan)->format('d M Y') }}</td>
                                <td class="p-4 font-semibold text-slate-800">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <form action="{{ route('bookings.update-status', $b->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_pembayaran" onchange="this.form.submit()" class="text-xs font-medium rounded-md p-1 border-0 focus:ring-2 focus:ring-[#5050F4] cursor-pointer
                                            {{ $b->status_pembayaran === 'paid' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                            {{ $b->status_pembayaran === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                            {{ $b->status_pembayaran === 'cancelled' ? 'bg-rose-100 text-rose-800' : '' }}
                                        ">
                                            <option value="pending" {{ $b->status_pembayaran === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $b->status_pembayaran === 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="cancelled" {{ $b->status_pembayaran === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400 bg-slate-50/30">Belum ada transaksi booking terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleLayananOptions() {
            const tipe = document.getElementById('tipe_layanan').value;
            const wrapper = document.getElementById('wrapper_layanan');
            const selects = document.querySelectorAll('.layanan-select');

            // Sembunyikan dan nonaktifkan semua dropdown detail paket terlebih dahulu
            selects.forEach(select => {
                select.classList.add('hidden');
                select.disabled = true;
                select.removeAttribute('name');
            });

            if (tipe) {
                wrapper.classList.remove('hidden');
                const targetSelect = document.getElementById('select_' + tipe);
                if (targetSelect) {
                    targetSelect.classList.remove('hidden');
                    targetSelect.disabled = false;
                    targetSelect.setAttribute('name', 'layanan_id'); // Pasang name atribut hanya pada select aktif
                }
            } else {
                wrapper.classList.add('hidden');
            }
        }
    </script>
</body>
</html>

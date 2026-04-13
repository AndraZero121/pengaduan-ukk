@extends('layouts.app')

@section('content')
<div class="px-4 py-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard Admin</h1>
        <p class="mt-1 text-sm text-slate-500">Kelola dan tindak lanjuti laporan dari siswa.</p>
    </div>

    <!-- Filter Form -->
    <div class="mb-6 bg-white p-6 border border-slate-100 rounded-2xl shadow-lg shadow-slate-200/30">
        <form action="{{ route('admin.aspirasi.index') }}" method="GET" id="filter-form" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5 items-end">
            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Cari Pelapor</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-9 pr-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" placeholder="NIS / Nama">
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Status</label>
                <select name="status" class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25em_1.25em] bg-[right_1rem_center] bg-no-repeat">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" @selected(request('status') == 'Menunggu')>Menunggu</option>
                    <option value="Proses" @selected(request('status') == 'Proses')>Proses</option>
                    <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Tipe</label>
                <select name="tipe" class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25em_1.25em] bg-[right_1rem_center] bg-no-repeat">
                    <option value="">Semua Tipe</option>
                    <option value="Pengaduan" @selected(request('tipe') == 'Pengaduan')>Pengaduan</option>
                    <option value="Aspirasi" @selected(request('tipe') == 'Aspirasi')>Aspirasi</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Kategori</label>
                <select name="id_kategori" class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25em_1.25em] bg-[right_1rem_center] bg-no-repeat">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" @selected(request('id_kategori') == $kat->id_kategori)>{{ $kat->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="w-full px-8 py-3.5 text-sm font-extrabold text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95">Filter</button>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-lg shadow-slate-200/40">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-32">ID & Waktu</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-48">Pelapor</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-24">Bukti</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Detail Laporan</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-80">Tindak Lanjut</th>
                    </tr>
                </thead>
                <tbody id="admin-table-body" class="divide-y divide-slate-50">
                    @include('repschool._admin_table', ['aspirasi' => $aspirasi])
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<section class="space-y-6">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-2xl font-bold">Panel Admin Aspirasi</h1>
                <p class="text-sm text-slate-600">Kelola status dan umpan balik pengaduan sarana sekolah.</p>
            </div>
            <form class="grid gap-3 sm:grid-cols-3" method="get" action="{{ route('admin.aspirasi.index') }}">
                <input class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" name="nis" placeholder="Filter NIS" value="{{ request('nis') }}">
                <select class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" name="id_kategori">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}" @selected(request('id_kategori') == $item->id_kategori)>
                            {{ $item->ket_kategori }}
                        </option>
                    @endforeach
                </select>
                <select class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" name="status">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" @selected(request('status') === 'Menunggu')>Menunggu</option>
                    <option value="Proses" @selected(request('status') === 'Proses')>Proses</option>
                    <option value="Selesai" @selected(request('status') === 'Selesai')>Selesai</option>
                </select>
                <button class="sm:col-span-3 inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-300/40 transition hover:-translate-y-0.5 hover:bg-black" type="submit">
                    <i class="fa-solid fa-filter"></i>
                    Terapkan Filter
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Siswa</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Lokasi &amp; Ket</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Feedback</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($aspirasi as $item)
                        <tr class="bg-white">
                            <td class="px-4 py-4 text-slate-500">#{{ $item->id_aspirasi }}</td>
                            <td class="px-4 py-4">
                                <p class="font-semibold">{{ $item->inputAspirasi?->siswa?->nis ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ $item->inputAspirasi?->siswa?->kelas ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4">{{ $item->kategori?->ket_kategori ?? '-' }}</td>
                            <td class="px-4 py-4">
                                <p class="font-semibold">{{ $item->inputAspirasi?->lokasi ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ $item->inputAspirasi?->ket ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-700">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4">{{ $item->feedback ?? '-' }}</td>
                            <td class="px-4 py-4">
                                <form class="flex flex-col gap-3" method="post" action="{{ route('admin.aspirasi.update', $item) }}">
                                    @csrf
                                    @method('patch')
                                    <select class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2 text-xs focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" name="status" required>
                                        <option value="Menunggu" @selected($item->status === 'Menunggu')>Menunggu</option>
                                        <option value="Proses" @selected($item->status === 'Proses')>Proses</option>
                                        <option value="Selesai" @selected($item->status === 'Selesai')>Selesai</option>
                                    </select>
                                    <input class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2 text-xs focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" name="feedback" value="{{ $item->feedback }}" placeholder="Tulis feedback singkat">
                                    <button class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-black" type="submit">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-10 text-center text-slate-500" colspan="7">Belum ada aspirasi masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

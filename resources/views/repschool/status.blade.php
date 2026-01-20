@extends('layouts.app')

@section('content')
<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-2xl font-bold">Cek Status Aspirasi</h1>
            <p class="text-sm text-slate-600">Masukkan NIS untuk melihat riwayat pengaduan.</p>
        </div>
        <form class="flex flex-col gap-3 sm:flex-row" method="get" action="{{ route('aspirasi.status') }}">
            <input class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" name="nis" placeholder="NIS siswa" value="{{ $nis }}">
            <button class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-300/40 transition hover:-translate-y-0.5 hover:bg-black" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Feedback</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($riwayat as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $item->kategori?->ket_kategori ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $item->lokasi }}</td>
                        <td class="px-4 py-3">{{ $item->ket }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-700">
                                {{ $item->aspirasi?->status ?? 'Menunggu' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->aspirasi?->feedback ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-8 text-center text-slate-500" colspan="6">
                            Masukkan NIS untuk melihat data aspirasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

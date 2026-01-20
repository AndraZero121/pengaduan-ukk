@extends('layouts.app')

@section('content')
<div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
        <div class="mb-6 flex items-center gap-3">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-900 text-white">
                <i class="fa-solid fa-note-sticky text-xl"></i>
            </span>
            <div>
                <h1 class="text-2xl font-bold">Form Aspirasi Siswa</h1>
                <p class="text-sm text-slate-600">Laporkan kondisi sarana sekolah secara cepat dan rapi.</p>
            </div>
        </div>

        <form class="space-y-4" action="{{ route('aspirasi.store') }}" method="post">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="nis">NIS</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 231234" required>
                    @error('nis')
                        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="kelas">Kelas</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL 1" required>
                    @error('kelas')
                        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700" for="id_kategori">Kategori</label>
                <select class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" id="id_kategori" name="id_kategori" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}" @selected(old('id_kategori') == $item->id_kategori)>
                            {{ $item->ket_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700" for="lokasi">Lokasi</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lab Komputer" required>
                @error('lokasi')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700" for="ket">Keterangan Singkat</label>
                <textarea class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" id="ket" name="ket" rows="4" placeholder="Jelaskan masalahnya" required>{{ old('ket') }}</textarea>
                @error('ket')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <button class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-300/40 transition hover:-translate-y-0.5 hover:bg-black" type="submit">
                <i class="fa-solid fa-paper-plane"></i>
                Kirim Aspirasi
            </button>
        </form>
    </section>

    <aside class="space-y-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Alur Repschool</p>
            <h2 class="mt-3 text-2xl font-semibold">Mulai dari laporan siswa, berakhir pada perbaikan nyata.</h2>
            <p class="mt-3 text-sm text-slate-600">Setiap aspirasi masuk otomatis tercatat dengan status Menunggu, lalu admin memberikan tindak lanjut.</p>
            <div class="mt-6 grid gap-3 text-sm">
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3">
                    <i class="fa-solid fa-clipboard-list text-slate-600"></i>
                    <span>Input aspirasi oleh siswa</span>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3">
                    <i class="fa-solid fa-gear text-slate-600"></i>
                    <span>Admin memproses dan memberi umpan balik</span>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3">
                    <i class="fa-solid fa-check text-slate-600"></i>
                    <span>Status selesai dilaporkan kembali</span>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
            <h3 class="text-lg font-semibold">Butuh cek status?</h3>
            <p class="mt-2 text-sm text-slate-600">Gunakan menu Cek Status untuk melihat progres aspirasi kamu.</p>
            <a class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-900" href="{{ route('aspirasi.status') }}">
                Lihat status aspirasi
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </aside>
</div>
@endsection

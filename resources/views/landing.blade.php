@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-20 text-center sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900 sm:text-5xl">
        Sistem Pengaduan & Aspirasi
    </h1>
    <p class="mt-4 text-slate-600">
        Wadah resmi bagi siswa SMK Palapa untuk menyampaikan laporan dan saran.
    </p>

    <div class="mt-10 flex justify-center gap-4">
        @auth
            <a href="{{ route('home') }}" class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Buat Laporan
            </a>
            <a href="{{ route('aspirasi.status') }}" class="rounded-lg border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Cek Status
            </a>
        @else
            <a href="{{ route('login') }}" class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Masuk ke Sistem
            </a>
        @endauth
    </div>
</div>
@endsection

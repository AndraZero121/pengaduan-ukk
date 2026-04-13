@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 pt-32 pb-20 text-center sm:px-6 lg:px-8">
    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 mb-8 animate-fade-in">
        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
        <span class="text-[10px] font-bold text-indigo-700 uppercase tracking-widest">Sistem Pengaduan v2.0</span>
    </div>
    
    <h1 class="text-4xl font-extrabold text-slate-900 sm:text-7xl tracking-tight mb-6">
        Sampaikan <span class="text-indigo-600">Aspirasi</span> & <br class="hidden sm:block"> 
        Laporan Anda.
    </h1>
    
    <p class="mx-auto max-w-xl text-lg text-slate-500 leading-relaxed mb-12">
        Wadah resmi bagi siswa SMK Palapa untuk menyampaikan laporan dan saran secara cepat, transparan, dan terpercaya.
    </p>

    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
        @auth
            <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95">
                Buat Laporan
            </a>
            <a href="{{ route('aspirasi.status') }}" class="w-full sm:w-auto px-10 py-4 bg-white text-slate-700 font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all active:scale-95">
                Cek Status
            </a>
        @else
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-12 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95">
                Masuk ke Sistem
            </a>
        @endauth
    </div>

    <div class="mt-24 grid grid-cols-1 sm:grid-cols-3 gap-8 text-left">
        <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-4">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h3 class="font-bold text-slate-900 mb-2">Respon Cepat</h3>
            <p class="text-sm text-slate-500">Laporan Anda akan segera ditinjau oleh tim admin kami.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-4">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h3 class="font-bold text-slate-900 mb-2">Privasi Aman</h3>
            <p class="text-sm text-slate-500">Identitas pelapor terlindungi dan hanya dapat diakses admin.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-4">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <h3 class="font-bold text-slate-900 mb-2">Transparan</h3>
            <p class="text-sm text-slate-500">Pantau proses penanganan laporan Anda secara real-time.</p>
        </div>
    </div>
</div>
@endsection

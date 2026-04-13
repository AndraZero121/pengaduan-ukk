@extends('layouts.app')

@section('content')
<div class="px-4 py-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tambah Kategori</h1>
        <p class="mt-1 text-sm text-slate-500">Buat kategori baru untuk pengaduan dan aspirasi.</p>
    </div>

    <form action="{{ route('admin.kategori.store') }}" method="POST" class="bg-white p-8 border border-slate-100 rounded-3xl shadow-xl shadow-slate-200/40">
        @csrf
        <div class="space-y-6">
            <div class="space-y-2">
                <label for="ket_kategori" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Nama Kategori</label>
                <input type="text" name="ket_kategori" id="ket_kategori" value="{{ old('ket_kategori') }}" required class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('ket_kategori') border-red-500 @enderror" placeholder="Contoh: Sarana & Prasarana">
                @error('ket_kategori')
                    <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-grow px-8 py-4 text-sm font-extrabold text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95">Simpan Kategori</button>
                <a href="{{ route('admin.kategori.index') }}" class="px-8 py-4 text-sm font-extrabold text-slate-500 bg-slate-100 rounded-2xl transition-all hover:bg-slate-200 active:scale-95 text-center">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection

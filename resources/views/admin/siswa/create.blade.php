@extends('layouts.app')

@section('content')
<div class="px-4 py-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tambah Siswa</h1>
        <p class="mt-1 text-sm text-slate-500">Daftarkan siswa baru ke dalam sistem.</p>
    </div>

    <form action="{{ route('admin.siswa.store') }}" method="POST" class="bg-white p-8 border border-slate-100 rounded-3xl shadow-xl shadow-slate-200/40">
        @csrf
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('name') border-red-500 @enderror" placeholder="Contoh: John Doe">
                    @error('name')
                        <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="nis" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">NIS (10 Digit)</label>
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}" required maxlength="10" class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('nis') border-red-500 @enderror" placeholder="1234567890">
                    @error('nis')
                        <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('email') border-red-500 @enderror" placeholder="john@example.com">
                @error('email')
                    <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kelas" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Kelas</label>
                    <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" required class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('kelas') border-red-500 @enderror" placeholder="Contoh: XII RPL 1">
                    @error('kelas')
                        <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-5 py-4 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 @error('password') border-red-500 @enderror" placeholder="Min. 8 karakter">
                    @error('password')
                        <p class="text-xs text-red-500 font-bold px-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-grow px-8 py-4 text-sm font-extrabold text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95">Simpan Data Siswa</button>
                <a href="{{ route('admin.siswa.index') }}" class="px-8 py-4 text-sm font-extrabold text-slate-500 bg-slate-100 rounded-2xl transition-all hover:bg-slate-200 active:scale-95 text-center">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection

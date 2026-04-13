@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md px-4 py-32">
    <div class="rounded-3xl border border-slate-100 bg-white p-10 shadow-xl shadow-slate-200/50">
        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
            <p class="mt-2 text-sm text-slate-500">Masuk ke akun Anda untuk melanjutkan.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-xs font-bold text-slate-700 uppercase tracking-wider">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </div>
                    <input type="email" name="email" id="email" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3.5 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        placeholder="nama@contoh.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-xs font-bold text-slate-700 uppercase tracking-wider">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3.5 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        placeholder="••••••••" required>
                </div>
                @error('password')
                    <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full rounded-2xl bg-indigo-600 py-4 text-sm font-bold text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95">
                    Masuk Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-xl">
    <div class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Repschool Admin</p>
        <h1 class="mt-2 text-2xl font-bold text-slate-900">Masuk Sistem</h1>
        <p class="mt-2 text-sm text-slate-600">Hanya admin terdaftar yang dapat mengakses panel pengelolaan.</p>
    </div>

    <form class="space-y-4" action="{{ route('admin.login.store') }}" method="post">
        @csrf
        <div>
            <label class="text-sm font-semibold text-slate-700" for="username">Username</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" type="password" id="password" name="password" required>
            @error('password')
                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <button class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-300/40 transition hover:-translate-y-0.5 hover:bg-black" type="submit">
            <i class="fa-solid fa-right-to-bracket"></i>
            Masuk Admin
        </button>
    </form>
</section>
@endsection

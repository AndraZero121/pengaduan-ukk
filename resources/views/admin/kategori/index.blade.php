@extends('layouts.app')

@section('content')
<div class="px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Kategori</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola kategori pengaduan dan aspirasi.</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95 flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Kategori
        </a>
    </div>

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-100 rounded-xl text-xs font-bold flex items-center gap-3">
            <i class="fa-solid fa-circle-exclamation text-sm"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-lg shadow-slate-200/40">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-20">ID</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Keterangan Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-40 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($kategori as $kat)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $kat->id_kategori }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-700">{{ $kat->ket_kategori }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.kategori.edit', $kat) }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-folder-open text-xl"></i>
                                    </div>
                                    <p class="text-sm text-slate-400 font-medium">Belum ada kategori.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-8 flex justify-center">
        <a href="{{ route('admin.aspirasi.index') }}" class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Siswa</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola data siswa yang terdaftar di sistem.</p>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95 flex items-center gap-2">
            <i class="fa-solid fa-user-plus text-xs"></i>
            Tambah Siswa
        </a>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-lg shadow-slate-200/40">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-32">NIS</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Nama</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Email</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-32">Kelas</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($siswa as $s)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ $s->nis }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-700">{{ $s->user->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $s->user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 rounded-lg">{{ $s->kelas }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.siswa.edit', $s) }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" title="Edit">
                                        <i class="fa-solid fa-user-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', $s) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini? Akun user juga akan terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Hapus">
                                            <i class="fa-solid fa-user-minus text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-users-slash text-xl"></i>
                                    </div>
                                    <p class="text-sm text-slate-400 font-medium">Belum ada data siswa.</p>
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

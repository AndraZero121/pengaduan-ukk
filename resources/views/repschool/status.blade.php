@extends('layouts.app')

@section('content')
<div class="px-4 py-6">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Status Laporan</h1>
            <p class="mt-1 text-sm text-slate-500">Pantau perkembangan laporan dan aspirasi Anda.</p>
        </div>
        
        <div class="flex p-1 bg-slate-100 rounded-2xl w-fit">
            <a href="{{ route('aspirasi.status', ['view' => 'all', 'search' => $search]) }}" 
               class="px-6 py-2.5 text-xs font-bold rounded-xl transition-all {{ $view === 'all' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Semua Laporan
            </a>
            <a href="{{ route('aspirasi.status', ['view' => 'mine', 'search' => $search]) }}" 
               class="px-6 py-2.5 text-xs font-bold rounded-xl transition-all {{ $view === 'mine' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Laporan Saya
            </a>
        </div>
    </div>

    <div class="mb-8 relative max-w-md">
        <form action="{{ route('aspirasi.status') }}" method="get" id="search-form">
            <input type="hidden" name="view" value="{{ $view }}">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </div>
            <input type="text" name="search" id="search-input" value="{{ $search }}"
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-slate-200 rounded-xl outline-none transition-all focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10"
                   placeholder="Cari kata kunci atau NIS...">
        </form>
    </div>

    <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-xl shadow-slate-200/40">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Waktu</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Pelapor</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Tipe & Kategori</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Bukti</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Isi Laporan</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Tanggapan</th>
                    </tr>
                </thead>
                <tbody id="status-table-body" class="divide-y divide-slate-50">
                    @include('repschool._status_table', ['riwayat' => $riwayat, 'search' => $search])
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('search-input');
    const tableBody = document.getElementById('status-table-body');
    const view = '{{ $view }}';

    let timeout = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            const searchValue = searchInput.value;
            fetch(`{{ route('aspirasi.status') }}?search=${searchValue}&view=${view}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = data.html;
            });
        }, 500);
    });
</script>
@endpush

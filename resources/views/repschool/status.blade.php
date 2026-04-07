@extends('layouts.app')

@section('content')
<div class="px-4 py-10">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold">Status Laporan</h1>
        
        <div class="flex gap-2">
            <a href="{{ route('aspirasi.status', ['view' => 'all', 'search' => $search]) }}" 
               class="px-3 py-1.5 text-sm rounded border {{ $view === 'all' ? 'bg-indigo-50 border-indigo-200 text-indigo-700' : 'bg-white border-gray-200 hover:bg-gray-50' }}">
                Semua
            </a>
            <a href="{{ route('aspirasi.status', ['view' => 'mine', 'search' => $search]) }}" 
               class="px-3 py-1.5 text-sm rounded border {{ $view === 'mine' ? 'bg-indigo-50 border-indigo-200 text-indigo-700' : 'bg-white border-gray-200 hover:bg-gray-50' }}">
                Laporan Saya
            </a>
        </div>
    </div>

    <form action="{{ route('aspirasi.status') }}" method="get" id="search-form" class="mb-6">
        <input type="hidden" name="view" value="{{ $view }}">
        <input type="text" name="search" id="search-input" value="{{ $search }}"
               class="w-full sm:w-64 px-3 py-2 text-sm border border-gray-300 rounded focus:border-indigo-500 focus:outline-none"
               placeholder="Cari laporan...">
    </form>

    <div class="bg-white border border-gray-200 rounded overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-500">Tanggal</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Pelapor</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Tipe & Kategori</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Foto</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Detail</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Tanggapan</th>
                </tr>
            </thead>
            <tbody id="status-table-body" class="divide-y divide-gray-100">
                @include('repschool._status_table', ['riwayat' => $riwayat, 'search' => $search])
            </tbody>
        </table>
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

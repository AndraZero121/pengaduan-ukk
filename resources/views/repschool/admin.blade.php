@extends('layouts.app')

@section('content')
<div class="px-4 py-10">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
    </div>

    <!-- Filter Form -->
    <div class="mb-6 bg-white p-4 border border-gray-200 rounded">
        <form action="{{ route('admin.aspirasi.index') }}" method="GET" id="filter-form" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-indigo-500 focus:outline-none" placeholder="NIS / Nama">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-indigo-500 focus:outline-none">
                    <option value="">Semua</option>
                    <option value="Menunggu" @selected(request('status') == 'Menunggu')>Menunggu</option>
                    <option value="Proses" @selected(request('status') == 'Proses')>Proses</option>
                    <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Tipe</label>
                <select name="tipe" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-indigo-500 focus:outline-none">
                    <option value="">Semua</option>
                    <option value="Pengaduan" @selected(request('tipe') == 'Pengaduan')>Pengaduan</option>
                    <option value="Aspirasi" @selected(request('tipe') == 'Aspirasi')>Aspirasi</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                <select name="id_kategori" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-indigo-500 focus:outline-none">
                    <option value="">Semua</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" @selected(request('id_kategori') == $kat->id_kategori)>{{ $kat->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded hover:bg-indigo-700">Filter</button>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white border border-gray-200 rounded overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-500 w-32">Info</th>
                    <th class="px-4 py-3 font-medium text-gray-500 w-48">Pelapor</th>
                    <th class="px-4 py-3 font-medium text-gray-500 w-20">Foto</th>
                    <th class="px-4 py-3 font-medium text-gray-500">Detail Laporan</th>
                    <th class="px-4 py-3 font-medium text-gray-500 w-64">Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody id="admin-table-body" class="divide-y divide-gray-100">
                @include('repschool._admin_table', ['aspirasi' => $aspirasi])
            </tbody>
        </table>
    </div>
</div>
@endsection

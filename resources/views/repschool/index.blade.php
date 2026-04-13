@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg shadow-slate-200/40 sm:p-8">
        <div class="mb-6 text-center sm:text-left">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Formulir Pelaporan</h1>
            <p class="mt-2 text-slate-500">
                Sampaikan keluhan atau saranmu secara langsung. Kami mendengarkan.
            </p>
        </div>

        <form action="{{ route('aspirasi.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            @error('error')
                <div class="rounded-2xl border border-red-200 bg-red-50 p-5 text-sm font-bold text-red-800 flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ $message }}
                </div>
            @enderror
            
            <div class="grid gap-5 md:grid-cols-2">
                <!-- Tipe Select -->
                <div class="space-y-3">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-widest px-1" for="tipe">
                        Jenis Laporan <span class="text-red-500">*</span>
                    </label>
                    <select class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25em_1.25em] bg-[right_1.25rem_center] bg-no-repeat" id="tipe" name="tipe" required onchange="toggleLokasi()">
                        <option value="Pengaduan" @selected(old('tipe') == 'Pengaduan')>Pengaduan (Masalah)</option>
                        <option value="Aspirasi" @selected(old('tipe') == 'Aspirasi')>Aspirasi (Saran)</option>
                    </select>
                    @error('tipe')
                        <p class="px-1 text-xs font-bold text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori Select -->
                <div class="space-y-3">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-widest px-1" for="id_kategori">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25em_1.25em] bg-[right_1.25rem_center] bg-no-repeat" id="id_kategori" name="id_kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}" @selected(old('id_kategori') == $item->id_kategori)>
                                {{ $item->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="px-1 text-xs font-bold text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lokasi Input -->
            <div class="space-y-3" id="lokasi-container">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-widest px-1" for="lokasi">
                    Lokasi <span class="text-red-500" id="lokasi-required">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-location-dot text-xs"></i>
                    </div>
                    <input class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3 pl-10 pr-4 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Gedung A, Ruang Kelas X-RPL">
                </div>
                @error('lokasi')
                    <p class="px-1 text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan Textarea -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-widest px-1" for="ket" id="ket-label">
                    Detail Laporan <span class="text-red-500">*</span>
                </label>
                <textarea class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-sm outline-none transition-all focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 min-h-[120px]" id="ket" name="ket" placeholder="Jelaskan secara rinci apa yang terjadi..." required>{{ old('ket') }}</textarea>
                @error('ket')
                    <p class="px-1 text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Input -->
            <div class="space-y-3">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-widest px-1" for="foto">
                    Lampiran Foto <span class="text-[10px] font-normal text-slate-400">(Opsional, Max 2MB)</span>
                </label>
                <div class="group relative flex min-h-[100px] cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/30 transition-all hover:border-indigo-400 hover:bg-indigo-50/30">
                    <input type="file" id="foto" name="foto" accept="image/*" class="absolute inset-0 z-10 cursor-pointer opacity-0" onchange="previewImage(this)">
                    <div class="flex flex-col items-center justify-center space-y-2 text-slate-500 transition-colors group-hover:text-indigo-600">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                        <p class="text-xs font-semibold">Klik atau tarik foto ke sini</p>
                    </div>
                </div>
                
                <div id="image-preview" class="mt-4 hidden animate-fade-in">
                    <div class="relative inline-block overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-sm">
                        <img src="" alt="Preview" class="h-40 w-auto rounded-xl object-cover">
                        <button type="button" onclick="clearPreview()" class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full bg-red-600 text-white shadow-lg transition-transform active:scale-90">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                @error('foto')
                    <p class="px-1 text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6">
                <button class="w-full rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95" type="submit">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleLokasi() {
        const tipe = document.getElementById('tipe').value;
        const lokasiContainer = document.getElementById('lokasi-container');
        const lokasiInput = document.getElementById('lokasi');
        const lokasiRequired = document.getElementById('lokasi-required');
        const ketLabel = document.getElementById('ket-label');

        if (tipe === 'Aspirasi') {
            lokasiContainer.classList.add('hidden');
            lokasiInput.disabled = true;
            lokasiInput.required = false;
            ketLabel.innerHTML = 'Isi Aspirasi <span class="text-red-500">*</span>';
        } else {
            lokasiContainer.classList.remove('hidden');
            lokasiInput.disabled = false;
            lokasiInput.required = true;
            ketLabel.innerHTML = 'Detail Laporan <span class="text-red-500">*</span>';
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearPreview() {
        const input = document.getElementById('foto');
        const preview = document.getElementById('image-preview');
        
        input.value = '';
        preview.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', toggleLokasi);
</script>
@endpush

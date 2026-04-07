@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-10">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Formulir Pelaporan</h1>
            <p class="mt-2 text-sm text-slate-500">
                Sampaikan keluhan atau saranmu di bawah ini.
            </p>
        </div>

        <form action="{{ route('aspirasi.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            @error('error')
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-800">
                    {{ $message }}
                </div>
            @enderror
            
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Tipe Select -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-900" for="tipe">
                        Jenis Laporan <span class="text-red-500">*</span>
                    </label>
                    <select class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 px-4 text-sm outline-none focus:border-indigo-600 focus:bg-white" id="tipe" name="tipe" required onchange="toggleLokasi()">
                        <option value="Pengaduan" @selected(old('tipe') == 'Pengaduan')>Pengaduan (Masalah)</option>
                        <option value="Aspirasi" @selected(old('tipe') == 'Aspirasi')>Aspirasi (Saran)</option>
                    </select>
                    @error('tipe')
                        <p class="text-xs font-bold text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori Select -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-900" for="id_kategori">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 px-4 text-sm outline-none focus:border-indigo-600 focus:bg-white" id="id_kategori" name="id_kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}" @selected(old('id_kategori') == $item->id_kategori)>
                                {{ $item->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="text-xs font-bold text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lokasi Input -->
            <div class="space-y-2" id="lokasi-container">
                <label class="text-sm font-semibold text-slate-900" for="lokasi">
                    Lokasi <span class="text-red-500" id="lokasi-required">*</span>
                </label>
                <input class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 px-4 text-sm outline-none focus:border-indigo-600 focus:bg-white" type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Gedung A, Ruang Kelas X-RPL">
                @error('lokasi')
                    <p class="text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan Textarea -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-900" for="ket" id="ket-label">
                    Detail Laporan <span class="text-red-500">*</span>
                </label>
                <textarea class="block w-full rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none focus:border-indigo-600 focus:bg-white" id="ket" name="ket" rows="4" placeholder="Jelaskan secara rinci..." required>{{ old('ket') }}</textarea>
                @error('ket')
                    <p class="text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Input -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-900" for="foto">
                    Lampiran Foto <span class="text-xs font-normal text-slate-400">(Opsional, Max 2MB)</span>
                </label>
                <input type="file" id="foto" name="foto" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" onchange="previewImage(this)">
                
                <div id="image-preview" class="mt-4 hidden">
                    <div class="relative inline-block">
                        <img src="" alt="Preview" class="h-32 w-auto rounded-lg border border-slate-200 object-cover">
                        <button type="button" onclick="clearPreview()" class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-600 text-white text-xs">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                @error('foto')
                    <p class="text-xs font-bold text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button class="w-full rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white transition hover:bg-indigo-700 active:scale-95" type="submit">
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

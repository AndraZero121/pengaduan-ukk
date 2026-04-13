@forelse ($riwayat as $item)
    <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="px-4 py-3 align-top">
            <div class="font-bold text-slate-900">{{ $item->created_at->format('d M Y') }}</div>
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">{{ $item->created_at->format('H:i') }} WIB</div>
        </td>
        <td class="px-4 py-3 align-top">
            <div class="font-bold text-slate-900 leading-tight">{{ $item->siswa?->user?->name ?? 'Anonim' }}</div>
            <div class="text-[10px] font-mono text-slate-400 mt-0.5">NIS: {{ $item->nis }}</div>
        </td>
        <td class="px-4 py-3 align-top">
            <span class="inline-flex px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider rounded-lg {{ $item->tipe === 'Pengaduan' ? 'bg-rose-50 text-rose-600' : 'bg-sky-50 text-sky-600' }}">
                {{ $item->tipe }}
            </span>
            <div class="mt-2 text-xs font-medium text-slate-500">{{ $item->kategori?->ket_kategori ?? '-' }}</div>
        </td>
        <td class="px-4 py-3 align-top">
            @if($item->foto)
                <button type="button" onclick="openImageModal('{{ asset('storage/' . $item->foto) }}')" class="group relative">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm transition-all group-hover:scale-110 group-hover:shadow-md cursor-zoom-in">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center text-white text-[10px]">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </div>
                </button>
            @else
                <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300">
                    <i class="fa-solid fa-image text-xs"></i>
                </div>
            @endif
        </td>
        <td class="px-4 py-3 align-top">
            @if($item->lokasi)
                <div class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-500 mb-1.5 px-2 py-0.5 bg-slate-100 rounded-md">
                    <i class="fa-solid fa-location-dot text-[9px]"></i>
                    {{ $item->lokasi }}
                </div>
            @endif
            <p class="text-sm text-slate-600 leading-relaxed italic line-clamp-3">"{{ $item->ket }}"</p>
        </td>
        <td class="px-4 py-3 align-top">
            @php $status = $item->aspirasi?->status ?? 'Menunggu'; @endphp
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-widest rounded-full
                {{ $status === 'Selesai' ? 'bg-emerald-50 text-emerald-600' : ($status === 'Proses' ? 'bg-amber-50 text-amber-600' : 'bg-slate-100 text-slate-400') }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $status === 'Selesai' ? 'bg-emerald-500' : ($status === 'Proses' ? 'bg-amber-500' : 'bg-slate-300') }}"></span>
                {{ $status }}
            </span>
        </td>
        <td class="px-6 py-5 align-top max-w-xs">
            @if($item->aspirasi?->feedback)
                <div class="text-xs text-slate-600 p-4 bg-slate-50 rounded-2xl border border-slate-100 relative">
                    <div class="absolute -left-1.5 top-4 w-3 h-3 bg-slate-50 border-l border-t border-slate-100 rotate-[-45deg]"></div>
                    <strong class="text-indigo-600 block mb-1">Admin:</strong> 
                    <span class="leading-relaxed">{{ $item->aspirasi->feedback }}</span>
                </div>
            @else
                <div class="text-[10px] font-bold text-slate-300 uppercase tracking-widest italic mt-1 flex items-center gap-2">
                    <span class="flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-1.5 w-1.5 rounded-full bg-slate-200 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-slate-200"></span>
                    </span>
                    Menunggu...
                </div>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-6 py-20 text-center">
            <div class="flex flex-col items-center justify-center space-y-3">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                    <i class="fa-solid fa-inbox text-2xl"></i>
                </div>
                <div>
                    @if($search)
                        <p class="text-sm font-bold text-slate-900">Hasil tidak ditemukan</p>
                        <p class="text-xs text-slate-400">Pencarian "{{ $search }}" tidak ada di sistem.</p>
                    @else
                        <p class="text-sm font-bold text-slate-900">Belum ada laporan</p>
                        <p class="text-xs text-slate-400">Silakan sampaikan aspirasi Anda terlebih dahulu.</p>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforelse

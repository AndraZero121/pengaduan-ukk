@forelse ($aspirasi as $item)
    <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="px-4 py-3 align-top">
            <div class="text-[10px] font-mono font-bold text-indigo-400 mb-1">#{{ str_pad($item->id_aspirasi, 4, '0', STR_PAD_LEFT) }}</div>
            <div class="text-xs font-bold text-slate-900">{{ $item->created_at?->format('d/m/y') }}</div>
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">{{ $item->created_at?->format('H:i') }}</div>
        </td>
        
        <td class="px-4 py-3 align-top">
            <div class="font-bold text-slate-900 leading-tight">{{ $item->inputAspirasi?->siswa?->user?->name ?? 'Anonim' }}</div>
            <div class="text-[10px] font-mono text-slate-400 mt-1">NIS: {{ $item->inputAspirasi?->nis }}</div>
        </td>

        <td class="px-4 py-3 align-top">
            @if($item->inputAspirasi?->foto)
                <button type="button" onclick="openImageModal('{{ asset('storage/' . $item->inputAspirasi->foto) }}')" class="group relative">
                    <img src="{{ asset('storage/' . $item->inputAspirasi->foto) }}" class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm transition-all group-hover:scale-110 group-hover:shadow-md cursor-zoom-in">
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
            <div class="mb-2 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-0.5 text-[9px] font-extrabold uppercase tracking-wider rounded-md {{ $item->inputAspirasi?->tipe === 'Pengaduan' ? 'bg-rose-50 text-rose-600' : 'bg-sky-50 text-sky-600' }}">
                    {{ $item->inputAspirasi?->tipe }}
                </span>
                <span class="inline-flex px-2 py-0.5 text-[9px] font-bold text-slate-500 bg-slate-100 rounded-md">{{ $item->kategori?->ket_kategori }}</span>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed italic line-clamp-2">"{{ $item->inputAspirasi?->ket }}"</p>
        </td>

        <td class="px-4 py-3 align-top">
            <form method="post" action="{{ route('admin.aspirasi.update', $item) }}" class="space-y-3">
                @csrf
                @method('patch')
                
                <div class="flex gap-2">
                    <select name="status" class="flex-1 text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 outline-none focus:border-indigo-600 focus:bg-white transition-all appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1em_1em] bg-[right_0.75rem_center] bg-no-repeat" required>
                        <option value="Menunggu" @selected($item->status === 'Menunggu')>Menunggu</option>
                        <option value="Proses" @selected($item->status === 'Proses')>Proses</option>
                        <option value="Selesai" @selected($item->status === 'Selesai')>Selesai</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white text-[10px] font-extrabold uppercase tracking-widest px-4 py-2 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-95">Update</button>
                </div>
                
                <textarea name="feedback" rows="1" class="w-full text-xs border border-slate-200 rounded-xl px-3 py-2 bg-slate-50 outline-none focus:border-indigo-600 focus:bg-white transition-all min-h-[60px]" placeholder="Tulis tanggapan admin di sini...">{{ $item->feedback }}</textarea>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-6 py-20 text-center">
            <div class="flex flex-col items-center justify-center space-y-3 text-slate-300">
                <i class="fa-solid fa-clipboard-list text-4xl"></i>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada laporan</p>
            </div>
        </td>
    </tr>
@endforelse

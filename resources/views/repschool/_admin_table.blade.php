@forelse ($aspirasi as $item)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-4 align-top w-32">
            <div class="text-[10px] font-mono text-gray-400 mb-1">#{{ str_pad($item->id_aspirasi, 4, '0', STR_PAD_LEFT) }}</div>
            <div class="text-xs text-gray-600">{{ $item->created_at?->format('d/m/y H:i') }}</div>
        </td>
        
        <td class="px-4 py-4 align-top w-48">
            <div class="font-medium text-gray-900">{{ $item->inputAspirasi?->siswa?->user?->name ?? 'Anonim' }}</div>
            <div class="text-xs text-gray-500">NIS: {{ $item->inputAspirasi?->nis }}</div>
        </td>

        <td class="px-4 py-4 align-top w-20">
            @if($item->inputAspirasi?->foto)
                <button type="button" onclick="openImageModal('{{ asset('storage/' . $item->inputAspirasi->foto) }}')">
                    <img src="{{ asset('storage/' . $item->inputAspirasi->foto) }}" class="w-12 h-12 object-cover rounded border border-gray-200 shadow-sm cursor-zoom-in hover:opacity-80 transition">
                </button>
            @else
                <span class="text-[10px] text-gray-300 italic">No Image</span>
            @endif
        </td>

        <td class="px-4 py-4 align-top">
            <div class="mb-1">
                <span class="text-[10px] font-bold uppercase mr-2 {{ $item->inputAspirasi?->tipe === 'Pengaduan' ? 'text-red-600' : 'text-blue-600' }}">
                    {{ $item->inputAspirasi?->tipe }}
                </span>
                <span class="text-[10px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded">{{ $item->kategori?->ket_kategori }}</span>
            </div>
            <p class="text-sm text-gray-700 italic">"{{ $item->inputAspirasi?->ket }}"</p>
        </td>

        <td class="px-4 py-4 align-top w-64">
            <form method="post" action="{{ route('admin.aspirasi.update', $item) }}" class="space-y-2">
                @csrf
                @method('patch')
                
                <div class="flex gap-1">
                    <select name="status" class="flex-1 text-xs border border-gray-300 rounded px-1 py-1 focus:border-indigo-500 outline-none" required>
                        <option value="Menunggu" @selected($item->status === 'Menunggu')>Menunggu</option>
                        <option value="Proses" @selected($item->status === 'Proses')>Proses</option>
                        <option value="Selesai" @selected($item->status === 'Selesai')>Selesai</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded hover:bg-indigo-700">Update</button>
                </div>
                
                <textarea name="feedback" rows="1" class="w-full text-xs border border-gray-300 rounded px-2 py-1 focus:border-indigo-500 outline-none" placeholder="Tanggapan...">{{ $item->feedback }}</textarea>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-4 py-8 text-center text-gray-500 text-sm">
            Tidak ada laporan untuk diproses.
        </td>
    </tr>
@endforelse

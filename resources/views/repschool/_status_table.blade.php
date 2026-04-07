@forelse ($riwayat as $item)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-4 align-top w-32">
            <div class="font-medium text-gray-900">{{ $item->created_at->format('d M Y') }}</div>
            <div class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }} WIB</div>
        </td>
        <td class="px-4 py-4 align-top w-40">
            <div class="font-medium text-gray-900">{{ $item->siswa?->user?->name ?? 'Anonim' }}</div>
            <div class="text-xs text-gray-500">NIS: {{ $item->nis }}</div>
        </td>
        <td class="px-4 py-4 align-top w-32">
            <span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase rounded {{ $item->tipe === 'Pengaduan' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                {{ $item->tipe }}
            </span>
            <div class="mt-1 text-xs text-gray-600">{{ $item->kategori?->ket_kategori ?? '-' }}</div>
        </td>
        <td class="px-4 py-4 align-top w-20">
            @if($item->foto)
                <button type="button" onclick="openImageModal('{{ asset('storage/' . $item->foto) }}')">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="w-12 h-12 object-cover rounded border border-gray-200 cursor-zoom-in hover:opacity-80 transition">
                </button>
            @else
                <span class="text-[10px] text-gray-300 italic">No Image</span>
            @endif
        </td>
        <td class="px-4 py-4 align-top">
            @if($item->lokasi)
                <div class="text-xs font-semibold text-gray-900 mb-0.5">{{ $item->lokasi }}</div>
            @endif
            <p class="text-sm text-gray-700 leading-relaxed italic">"{{ $item->ket }}"</p>
        </td>
        <td class="px-4 py-4 align-top w-24">
            @php $status = $item->aspirasi?->status ?? 'Menunggu'; @endphp
            <span class="text-[10px] font-bold uppercase tracking-wider 
                {{ $status === 'Selesai' ? 'text-green-600' : ($status === 'Proses' ? 'text-yellow-600' : 'text-gray-400') }}">
                {{ $status }}
            </span>
        </td>
        <td class="px-4 py-4 align-top max-w-xs">
            @if($item->aspirasi?->feedback)
                <div class="text-xs text-gray-600 p-2 bg-gray-50 rounded border border-gray-100">
                    <strong>Admin:</strong> {{ $item->aspirasi->feedback }}
                </div>
            @else
                <span class="text-[10px] text-gray-400 italic">Menunggu tanggapan...</span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-4 py-8 text-center text-gray-500 text-sm">
            @if($search)
                Hasil pencarian "{{ $search }}" tidak ditemukan.
            @else
                Belum ada data laporan.
            @endif
        </td>
    </tr>
@endforelse

<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Services\ProfanityFilter;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function __construct(protected ProfanityFilter $filter) {}

    public function index(Request $request)
    {
        $query = Aspirasi::query()->with(['inputAspirasi.siswa', 'kategori']);

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->integer('id_kategori'));
        }

        if ($request->filled('tipe')) {
            $tipe = $request->string('tipe')->toString();
            $query->whereHas('inputAspirasi', function ($builder) use ($tipe): void {
                $builder->where('tipe', $tipe);
            });
        }

        if ($request->filled('nis')) {
            $nis = $request->string('nis')->toString();
            $query->whereHas('inputAspirasi', function ($builder) use ($nis): void {
                $builder->where('nis', $nis);
            });
        }

        if ($request->filled('tanggal')) {
            $tanggal = $request->date('tanggal');
            $query->whereHas('inputAspirasi', function ($builder) use ($tanggal): void {
                $builder->whereDate('created_at', $tanggal);
            });
        }

        if ($request->filled('bulan')) {
            $bulan = (int) $request->input('bulan');
            $tahun = (int) $request->input('tahun', now()->year);

            $query->whereHas('inputAspirasi', function ($builder) use ($bulan, $tahun): void {
                $builder->whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan);
            });
        }

        $aspirasi = $query->latest()->get();

        return response()->json($aspirasi);
    }

    public function show(Aspirasi $aspirasi)
    {
        return response()->json($aspirasi->load(['inputAspirasi.siswa', 'kategori']));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        $data = $request->validate([
            'status' => ['sometimes', 'in:Menunggu,Proses,Selesai'],
            'feedback' => ['nullable', 'string', 'max:255'],
            'id_kategori' => ['sometimes', 'integer', 'exists:kategori,id_kategori'],
        ]);

        if (isset($data['feedback'])) {
            $data['feedback'] = $this->filter->filter($data['feedback']);
        }

        $aspirasi->update($data);

        return response()->json($aspirasi->load(['inputAspirasi.siswa', 'kategori']));
    }
}

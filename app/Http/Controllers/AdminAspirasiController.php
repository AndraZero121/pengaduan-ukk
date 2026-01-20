<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminAspirasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::query()->with(['inputAspirasi.siswa', 'kategori']);

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->integer('id_kategori'));
        }

        if ($request->filled('nis')) {
            $nis = $request->string('nis')->toString();
            $query->whereHas('inputAspirasi', function ($builder) use ($nis): void {
                $builder->where('nis', $nis);
            });
        }

        $aspirasi = $query->latest()->get();
        $kategori = Kategori::query()->orderBy('ket_kategori')->get();

        return view('repschool.admin', compact('aspirasi', 'kategori'));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Menunggu,Proses,Selesai'],
            'feedback' => ['nullable', 'string', 'max:255'],
        ]);

        $aspirasi->update($data);

        return back()->with('success', 'Status aspirasi diperbarui.');
    }
}

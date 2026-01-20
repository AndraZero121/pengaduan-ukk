<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepschoolController extends Controller
{
    public function index()
    {
        $kategori = Kategori::query()->orderBy('ket_kategori')->get();

        return view('repschool.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:10'],
            'kelas' => ['required', 'string', 'max:10'],
            'id_kategori' => ['required', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['required', 'string', 'max:50'],
            'ket' => ['required', 'string', 'max:50'],
        ]);

        DB::transaction(function () use ($data): void {
            $siswa = Siswa::updateOrCreate(
                ['nis' => $data['nis']],
                ['kelas' => $data['kelas']]
            );

            $input = InputAspirasi::create([
                'nis' => $siswa->nis,
                'id_kategori' => $data['id_kategori'],
                'lokasi' => $data['lokasi'],
                'ket' => $data['ket'],
            ]);

            Aspirasi::create([
                'id_aspirasi' => $input->id_pelaporan,
                'status' => 'Menunggu',
                'id_kategori' => $input->id_kategori,
                'feedback' => null,
            ]);
        });

        return redirect()
            ->route('home')
            ->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function status(Request $request)
    {
        $nis = $request->string('nis')->toString();
        $riwayat = collect();

        if ($nis !== '') {
            $riwayat = InputAspirasi::query()
                ->with(['kategori', 'aspirasi'])
                ->where('nis', $nis)
                ->latest()
                ->get();
        }

        return view('repschool.status', compact('nis', 'riwayat'));
    }
}

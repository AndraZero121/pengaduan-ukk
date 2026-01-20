<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputAspirasiController extends Controller
{
    public function index()
    {
        $inputAspirasi = InputAspirasi::query()
            ->with(['siswa', 'kategori', 'aspirasi'])
            ->latest()
            ->get();

        return response()->json($inputAspirasi);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:10', 'exists:siswa,nis'],
            'id_kategori' => ['required', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['required', 'string', 'max:50'],
            'ket' => ['required', 'string', 'max:50'],
        ]);

        $inputAspirasi = DB::transaction(function () use ($data) {
            $input = InputAspirasi::create($data);

            Aspirasi::create([
                'id_aspirasi' => $input->id_pelaporan,
                'status' => 'Menunggu',
                'id_kategori' => $input->id_kategori,
                'feedback' => null,
            ]);

            return $input->load(['siswa', 'kategori', 'aspirasi']);
        });

        return response()->json($inputAspirasi, 201);
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        return response()->json($inputAspirasi->load(['siswa', 'kategori', 'aspirasi']));
    }

    public function update(Request $request, InputAspirasi $inputAspirasi)
    {
        $data = $request->validate([
            'id_kategori' => ['sometimes', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['sometimes', 'string', 'max:50'],
            'ket' => ['sometimes', 'string', 'max:50'],
        ]);

        $inputAspirasi->update($data);

        if (array_key_exists('id_kategori', $data) && $inputAspirasi->aspirasi) {
            $inputAspirasi->aspirasi->update(['id_kategori' => $data['id_kategori']]);
        }

        return response()->json($inputAspirasi->load(['siswa', 'kategori', 'aspirasi']));
    }

    public function destroy(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->delete();

        return response()->json(['message' => 'Aspirasi input deleted']);
    }
}

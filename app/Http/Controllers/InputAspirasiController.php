<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Services\ProfanityFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputAspirasiController extends Controller
{
    public function __construct(protected ProfanityFilter $filter) {}

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
            'tipe' => ['required', 'in:Pengaduan,Aspirasi'],
            'nis' => ['required', 'string', 'max:10', 'exists:siswa,nis'],
            'id_kategori' => ['required', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['required_if:tipe,Pengaduan', 'nullable', 'string', 'max:50'],
            'ket' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        // Capture IP address
        $ip = $request->ip();

        // Profanity Filtering
        $data['ket'] = $this->filter->filter($data['ket']);
        if (isset($data['lokasi'])) {
            $data['lokasi'] = $this->filter->filter($data['lokasi']);
        }

        $inputAspirasi = DB::transaction(function () use ($request, $data, $ip) {
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('pengaduan', 'public');
            }

            $input = InputAspirasi::create([
                'tipe' => $data['tipe'],
                'nis' => $data['nis'],
                'id_kategori' => $data['id_kategori'],
                'lokasi' => $data['lokasi'] ?? null,
                'ket' => $data['ket'],
                'foto' => $path,
                'ip_address' => $ip,
            ]);

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
            'tipe' => ['sometimes', 'in:Pengaduan,Aspirasi'],
            'id_kategori' => ['sometimes', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['sometimes', 'nullable', 'string', 'max:50'],
            'ket' => ['sometimes', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if (isset($data['ket'])) {
            $data['ket'] = $this->filter->filter($data['ket']);
        }
        if (isset($data['lokasi'])) {
            $data['lokasi'] = $this->filter->filter($data['lokasi']);
        }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pengaduan', 'public');
            $data['foto'] = $path;
        }

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

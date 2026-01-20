<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return response()->json(Siswa::query()->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:10', 'unique:siswa,nis'],
            'kelas' => ['required', 'string', 'max:10'],
        ]);

        $siswa = Siswa::create($data);

        return response()->json($siswa, 201);
    }

    public function show(Siswa $siswa)
    {
        return response()->json($siswa);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'kelas' => ['sometimes', 'string', 'max:10'],
        ]);

        $siswa->update($data);

        return response()->json($siswa);
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return response()->json(['message' => 'Siswa deleted']);
    }
}

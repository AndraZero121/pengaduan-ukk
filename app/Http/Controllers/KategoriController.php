<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::query()->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ket_kategori' => ['required', 'string', 'max:30'],
        ]);

        $kategori = Kategori::create($data);

        return response()->json($kategori, 201);
    }

    public function show(Kategori $kategori)
    {
        return response()->json($kategori);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'ket_kategori' => ['sometimes', 'string', 'max:30'],
        ]);

        $kategori->update($data);

        return response()->json($kategori);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json(['message' => 'Kategori deleted']);
    }
}

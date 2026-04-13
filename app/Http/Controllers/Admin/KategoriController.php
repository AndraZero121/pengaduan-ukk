<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KategoriController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $request->validate([
            'ket_kategori' => 'required|string|max:255|unique:kategori,ket_kategori',
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $request->validate([
            'ket_kategori' => 'required|string|max:255|unique:kategori,ket_kategori,' . $kategori->id_kategori . ',id_kategori',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        // Check if category is used in aspirasi
        if ($kategori->aspirasi()->exists() || $kategori->inputAspirasi()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam aspirasi.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

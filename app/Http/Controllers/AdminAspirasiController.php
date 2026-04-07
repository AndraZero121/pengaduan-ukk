<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Services\ProfanityFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminAspirasiController extends Controller
{
    public function __construct(protected ProfanityFilter $filter) {}

    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $query = Aspirasi::query()->with(['inputAspirasi.siswa.user', 'kategori']);

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('tipe')) {
            $query->whereHas('inputAspirasi', function ($builder) use ($request): void {
                $builder->where('tipe', $request->string('tipe')->toString());
            });
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->integer('id_kategori'));
        }

        if ($request->filled('archived')) {
            $archived = $request->string('archived')->toString();
            if ($archived === 'yes') {
                $query->whereNotNull('archived_at');
            } elseif ($archived === 'no') {
                $query->whereNull('archived_at');
            }
        }

        $search = $request->string('search')->toString();
        if ($search !== '') {
            $query->whereHas('inputAspirasi.siswa', function ($builder) use ($search): void {
                $builder->where('nis', 'like', "%$search%")
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('name', 'like', "%$search%");
                    });
            });
        }

        $aspirasi = $query->latest()->get();
        $kategori = Kategori::query()->orderBy('ket_kategori')->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('repschool._admin_table', compact('aspirasi'))->render(),
            ]);
        }

        return view('repschool.admin', compact('aspirasi', 'kategori'));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $data = $request->validate([
            'status' => ['required', 'in:Menunggu,Proses,Selesai'],
            'feedback' => ['nullable', 'string', 'max:255'],
        ]);

        if (isset($data['feedback'])) {
            $data['feedback'] = $this->filter->filter($data['feedback']);
        }

        $aspirasi->update($data);

        return back()->with('success', 'Status aspirasi diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Services\ProfanityFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RepschoolController extends Controller
{
    public function __construct(protected ProfanityFilter $filter) {}

    public function index()
    {
        if (Gate::denies('siswa')) {
            abort(403);
        }

        $kategori = Kategori::query()->orderBy('ket_kategori')->get();

        return view('repschool.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('siswa')) {
            abort(403);
        }

        $siswa = Auth::user()->siswa;

        $data = $request->validate([
            'tipe' => ['required', 'in:Pengaduan,Aspirasi'],
            'id_kategori' => ['required', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['required_if:tipe,Pengaduan', 'nullable', 'string', 'max:50'],
            'ket' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        // Capture IP address
        $ip = $request->ip();

        // Profanity Filtering
        $data['ket'] = $this->filter->filter($data['ket']);
        if (isset($data['lokasi'])) {
            $data['lokasi'] = $this->filter->filter($data['lokasi']);
        }

        // Check for duplicates (still in 'Menunggu' or 'Proses')
        $duplicate = InputAspirasi::query()
            ->where('tipe', $data['tipe'])
            ->where('id_kategori', $data['id_kategori'])
            ->whereHas('aspirasi', function ($q) {
                $q->whereIn('status', ['Menunggu', 'Proses']);
            })
            ->where(function ($q) use ($data) {
                // Check if location is same (if Pengaduan) AND description is similar
                if ($data['tipe'] === 'Pengaduan') {
                    $q->where('lokasi', $data['lokasi'] ?? null)
                        ->where('ket', 'like', "%{$data['ket']}%");
                } else {
                    // For Aspirasi, just check the description
                    $q->where('ket', 'like', "%{$data['ket']}%");
                }
            })
            ->exists();

        if ($duplicate) {
            $message = $data['tipe'] === 'Pengaduan'
                ? 'Laporan dengan deskripsi serupa di lokasi ini sedang ditangani.'
                : 'Aspirasi serupa telah disampaikan dan sedang dalam proses.';

            return back()->withInput()->withErrors(['error' => $message]);
        }

        DB::transaction(function () use ($request, $data, $siswa, $ip): void {
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('pengaduan', 'public');
            }

            $input = InputAspirasi::create([
                'tipe' => $data['tipe'],
                'nis' => $siswa->nis,
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
        });

        return redirect()
            ->route('home')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function status(Request $request)
    {
        if (Gate::denies('siswa')) {
            abort(403);
        }

        $siswa = Auth::user()->siswa;
        $search = $request->string('search')->toString();
        $view = $request->string('view', 'all')->toString(); // Default to 'all' to see others' reports

        $query = InputAspirasi::query()
            ->with(['kategori', 'aspirasi', 'siswa.user']);

        // Filter by ownership if requested
        if ($view === 'mine') {
            $query->where('nis', $siswa->nis);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', "%$search%")
                    ->orWhere('lokasi', 'like', "%$search%")
                    ->orWhere('ket', 'like', "%$search%")
                    ->orWhereHas('kategori', function ($qk) use ($search) {
                        $qk->where('ket_kategori', 'like', "%$search%");
                    })
                    ->orWhereHas('siswa.user', function ($qu) use ($search) {
                        $qu->where('name', 'like', "%$search%");
                    });
            });
        }

        $riwayat = $query->latest()->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('repschool._status_table', compact('riwayat', 'search'))->render(),
            ]);
        }

        return view('repschool.status', compact('siswa', 'riwayat', 'search', 'view'));
    }
}

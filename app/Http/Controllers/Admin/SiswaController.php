<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $siswa = Siswa::with('user')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nis' => 'required|string|size:10|unique:siswa,nis',
            'kelas' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            Siswa::create([
                'nis' => $request->nis,
                'user_id' => $user->id,
                'kelas' => $request->kelas,
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($siswa->user_id)],
            'password' => 'nullable|string|min:8',
            'nis' => ['required', 'string', 'size:10', Rule::unique('siswa')->ignore($siswa->nis, 'nis')],
            'kelas' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $siswa) {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $siswa->user()->update($userData);

            $siswa->update([
                'nis' => $request->nis,
                'kelas' => $request->kelas,
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if (Gate::denies('admin')) {
            abort(403);
        }

        DB::transaction(function () use ($siswa) {
            $user = $siswa->user;
            $siswa->delete();
            $user->delete();
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('repschool.login');
    }

    public function login(Request $request)
    {
        // Validasi data
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::query()->where('username', $data['username'])->first();
         // Cek login
        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return back()->withErrors(['username' => 'Username atau password tidak sesuai.'])->onlyInput('username');
        }

        $request->session()->put('admin_id', $admin->id);

        return redirect()->route('admin.aspirasi.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}

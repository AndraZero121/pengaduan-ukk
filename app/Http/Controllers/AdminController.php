<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Admin::query()->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $admin = Admin::create($data);

        return response()->json($admin, 201);
    }

    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'username' => ['sometimes', 'string', 'max:50', 'unique:admins,username,' . $admin->id],
            'password' => ['sometimes', 'string', 'min:6'],
        ]);

        if (array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);

        return response()->json($admin);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return response()->json(['message' => 'Admin deleted']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4|max:8',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'admin',
            'status' => $request->status
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $admin->username = $request->username;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->status = $request->status;
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}
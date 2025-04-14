<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:25',
            'harga_per_kg' => 'required|numeric',
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga_per_kg' => $request->harga_per_kg,
        ]);

        return redirect()->route('layanan.index');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|max:25',
            'harga_per_kg' => 'required|numeric',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga_per_kg' => $request->harga_per_kg,
        ]);

        return redirect()->route('layanan.index');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index');
    }
}


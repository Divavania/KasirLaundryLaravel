<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['pelanggan', 'layanan'])->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();
        return view('pesanan.create', compact('pelanggans', 'layanans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pelanggan_id' => 'required',
            'layanan_id' => 'required',
            'berat' => 'required|numeric',
        ]);

    // Ambil layanan yang dipilih untuk menghitung total harga
    $layanan = Layanan::find($request->layanan_id);
    // Hitung total harga
    $total_harga = $layanan->harga_per_kg * $request->berat;
    
        // Menyimpan pesanan dengan status otomatis 'Diproses'
        $pesanan = new Pesanan();
        $pesanan->pelanggan_id = $request->pelanggan_id;
        $pesanan->layanan_id = $request->layanan_id;
        $pesanan->berat = $request->berat;
        $layanan = Layanan::find($request->layanan_id);
        $pesanan->total_harga = $total_harga;
        $pesanan->status = 'Diproses'; // Status otomatis 'Diproses'
        $pesanan->save();

        // Mengganti pengalihan ke dashboard
    if (auth()->user()->role === 'superadmin') {
        return redirect()->route('superadmin.dashboard')->with('success', 'Pesanan berhasil ditambahkan!');
    } else {
        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    }

    public function edit(Pesanan $pesanan)
    {
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();
        return view('pesanan.edit', compact('pesanan', 'pelanggans', 'layanans'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'layanan_id' => 'required|exists:layanan,id',
            'berat' => 'required|numeric|min:0.1',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:Diproses,Selesai,Diambil',
        ]);

        $pesanan->update($request->all());

        return redirect()->back()->with('success', 'Pesanan berhasil diperbarui');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');

    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Diambil'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');

    }

    public function cetakNota($id)
    {
        $pesanan = Pesanan::with('pelanggan', 'layanan')->findOrFail($id);
        return view('pesanan.nota', compact('pesanan'));
    }
}

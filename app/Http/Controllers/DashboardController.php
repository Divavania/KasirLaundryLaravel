<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query untuk mengambil semua data pesanan
        $query = Pesanan::with(['pelanggan', 'layanan']);
        
        // Mengecek apakah ada input pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            
            // Mencari berdasarkan nama pelanggan atau nama layanan
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('layanan', function ($q) use ($search) {
                $q->where('nama_layanan', 'like', '%' . $search . '%');
            });
        }

        // Menjalankan query dan mendapatkan hasil pesanan
        $pesanans = $query->get();

        // Mengambil data pelanggan dan layanan untuk dropdown
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();

        // Menghitung total pesanan dan status selesai
        $totalPesanan = Pesanan::count();  // Menghitung total pesanan tanpa filter status
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();

        // Mengembalikan data ke view
        return view('dashboard', compact('pesanans', 'pelanggan', 'layanan', 'totalPesanan', 'totalSelesai'));
    }
}

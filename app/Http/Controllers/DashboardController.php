<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index()
{
    // Mengambil data pesanan
    $pesanans = Pesanan::with(['pelanggan', 'layanan'])->get();

    // Mengambil data pelanggan dan layanan untuk dropdown
    $pelanggan = Pelanggan::all();
    $layanan = Layanan::all();

    // Menghitung total pesanan dan status selesai
    $totalPesanan = Pesanan::count();
    $totalSelesai = Pesanan::where('status', 'Selesai')->count();

    return view('dashboard', compact('pesanans', 'pelanggan', 'layanan', 'totalPesanan', 'totalSelesai'));
}


    
}

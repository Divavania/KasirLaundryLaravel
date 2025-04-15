<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
{
    $pesanans = Pesanan::with(['pelanggan', 'layanan'])->orderBy('id', 'desc')->get();

    // Hitung total order dan yang selesai langsung dari koleksi
    $totalPesanan = $pesanans->count();
    $totalSelesai = $pesanans->where('status', 'Selesai')->count();

    return view('dashboard', compact('pesanans', 'totalPesanan', 'totalSelesai'));
}

    
}

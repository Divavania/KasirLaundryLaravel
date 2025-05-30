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
        $query = Pesanan::with(['pelanggan', 'layanan']);
        $searchNotFound = false;
        
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('layanan', function ($q) use ($search) {
                $q->where('nama_layanan', 'like', '%' . $search . '%');
            });
        }

        $pesanans = $query->get();

         if ($request->has('search') && $request->input('search') != '' && $pesanans->isEmpty()) {
            $searchNotFound = true;
        }

        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();

        $totalPesanan = Pesanan::count();
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();

        return view('dashboard', compact('pesanans', 'pelanggan', 'layanan', 'totalPesanan', 'totalSelesai', 'searchNotFound'));
    } 
}
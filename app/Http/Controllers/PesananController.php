<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'layanan_id' => 'required|array',
            'layanan_id.*' => 'exists:layanan,id',
            'berat' => 'required|array',
            'berat.*' => 'numeric|min:0.01',
        ]);

        try {
            DB::beginTransaction();

            Log::info('Store Request Data: ', $request->all());

            $total_harga = 0;
            $syncData = [];

            foreach ($request->layanan_id as $layananId) {
                $layanan = Layanan::findOrFail($layananId);
                $berat = floatval($request->berat[$layananId]);
                $harga_per_kg = floatval($layanan->harga_per_kg);
                $subtotal = $berat * $harga_per_kg;
                $total_harga += $subtotal;

                $syncData[$layananId] = [
                    'berat' => $berat,
                    'subtotal' => $subtotal,
                ];

                Log::info("Layanan ID: $layananId, Berat: $berat, Harga per kg: $harga_per_kg, Subtotal: $subtotal");
            }

            Log::info("Total Harga: $total_harga");

            $pesanan = Pesanan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'status' => 'Diproses',
                'tanggal_pesanan' => now()->timezone('Asia/Jakarta'),
                'total_harga' => $total_harga,
            ]);

            $pesanan->layanan()->sync($syncData);

            DB::commit();

            return redirect()->route(auth()->user()->role === 'superadmin' ? 'superadmin.dashboard' : 'admin.dashboard')
                            ->with('success', 'Pesanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing pesanan: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal menambahkan pesanan: ' . $e->getMessage());
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
            'layanan_id' => 'required|array',
            'layanan_id.*' => 'exists:layanan,id',
            'berat' => 'required|array',
            'berat.*' => 'numeric|min:0.01',
            'status' => 'required|in:Diproses,Selesai,Diambil',
        ]);

        try {
            DB::beginTransaction();

            $total_harga = 0;
            $syncData = [];

            foreach ($request->layanan_id as $index => $layananId) {
                $layanan = Layanan::findOrFail($layananId);
                $berat = floatval($request->berat[$index]);
                $subtotal = $berat * floatval($layanan->harga_per_kg);
                $total_harga += $subtotal;

                $syncData[$layananId] = [
                    'berat' => $berat,
                    'subtotal' => $subtotal,
                ];
            }

            $pesanan->update([
                'pelanggan_id' => $request->pelanggan_id,
                'status' => $request->status,
                'total_harga' => $total_harga,
            ]);

            $pesanan->layanan()->sync($syncData);

            DB::commit();

            return redirect()->back()->with('success', 'Pesanan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating pesanan: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal memperbarui pesanan: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, Pesanan $pesanan)
    {
        try {
            $pesanan->delete();
            if ($request->ajax()) {
                return response()->json(['success' => 'Pesanan berhasil dihapus.']);
            }
            return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting pesanan: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Gagal menghapus pesanan: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->withErrors('Gagal menghapus pesanan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Diambil'
        ]);

        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->status = $request->status;
            $pesanan->save();

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function cetakNota($id)
    {
        $pesanan = Pesanan::with('pelanggan', 'layanan')->findOrFail($id);
        return view('pesanan.nota', compact('pesanan'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $timestamps = false;

    protected $fillable = [
        'pelanggan_id', 'status', 'tanggal_pesanan', 'total_harga'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'pesanan_layanan')
                    ->withPivot('berat', 'subtotal');
    }
}
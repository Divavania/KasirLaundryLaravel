<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $fillable = ['nama_layanan', 'harga_per_kg'];
    public $timestamps = false;

    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_layanan')
                    ->withPivot('berat', 'subtotal');
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $timestamps = false;

    protected $fillable = [
        'pelanggan_id', 'layanan_id', 'berat', 'total_harga',
        'status', 'tanggal_pesanan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

}

?>
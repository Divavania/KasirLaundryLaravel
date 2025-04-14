<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan'; // karena bukan plural
    protected $fillable = ['nama_layanan', 'harga_per_kg'];
    public $timestamps = false; // jika tabel tidak pakai created_at dan updated_at
}

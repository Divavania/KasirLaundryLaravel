<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    public $timestamps = false;

    protected $fillable = ['nama', 'no_hp', 'alamat'];
}
?>
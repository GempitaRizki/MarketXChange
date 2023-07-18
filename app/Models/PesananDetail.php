<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $table = 'pesanandetails';
    protected $fillable = [
        'pesanan_id',
        'barang_id',
        'jumlah',
        'jumlah_harga',
        'pesanandetails'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'barang_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga_penawaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Product::class);
    }
    public function penawaran()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Penawaran::class);
    }
}

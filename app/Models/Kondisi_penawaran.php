<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi_penawaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function penawaran()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Penawaran::class);
    }
}

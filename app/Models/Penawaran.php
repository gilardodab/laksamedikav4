<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Customer::class);
    }

    public function kondisi_penawaran()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Kondisi_penawaran::class);
    }

    public function harga_penawaran()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Harga_penawaran::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

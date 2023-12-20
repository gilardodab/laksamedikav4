<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function invoice_detail()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Invoice_detail::class);
    }

    public function invoice_detailppn()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Invoice_detailppn::class);
    }

    public function product()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Customer::class);
    }
    
    public function pengiriman()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Pengiriman::class);
    }

    public function pengirimanppn()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Pengirimanppn::class);
    }
}

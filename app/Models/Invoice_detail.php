<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    //DEFINE ACCESSOR
    public function getSubtotalAttribute()
    {
        //NILAI DARI SUBTOTAL ADALAH QTY * PRICE kode diskon % -> (($this->qty * $this->price * $this->diskon) / 100))
        return number_format(($this->qty * $this->price) - $this->diskon);
    }


    //DEFINE RELATIONSHIPS
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
    
    public function pengiriman()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Pengiriman::class);
    }
}

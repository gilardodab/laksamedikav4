<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_detailppn extends Model
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

    public function invoiceppn()
    {
        return $this->belongsTo(Invoiceppn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
    
     public function pengirimanppn()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Pengirimanppn::class);
    }
}

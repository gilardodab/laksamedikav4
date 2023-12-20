<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_customer extends Model
{
    use HasFactory;
    //
    protected $guarded = [];
    protected $dates = ['tempo']; 

    public function getTaxAttribute()
    {
        //MENDAPATKAN TAX 2% DARI TOTAL HARGA
        return (($this->total * $this->ppn) / 100) - $this->diskon;
    }

    public function getTotalPriceAttribute()
    {
        //MENDAPATKAN TOTAL HARGA BARU YANG TELAH DIJUMLAHKAN DENGAN TAX (($this->total * $this->diskon) / 100)
        return (($this->total + (($this->total * $this->ppn) / 100)) - $this->diskon);
    }

    public function detail_customer()
    {
        return $this->hasMany(Invoice_customer_detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function paymentProofs()
    {
        return $this->hasMany(Invoice_customer::class, 'invoice_customer_id');
    }

}



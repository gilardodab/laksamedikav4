<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Invoiceppn extends Model
{
    use HasFactory;
    use SoftDeletes;

    //
    protected $guarded = [];
    protected $dates = ['tenggat']; //JANGAN LUPA TAMBAHKAN CODE INI
    //AGAR DAPAT MENYIMPAN DATA KEDALAM TABLE TERKAIT

    //DEFINE ACCESSOR
    public function getTaxAttribute()
    {
        //MENDAPATKAN TAX 2% DARI TOTAL HARGA
        return (($this->total * 11) / 100) - $this->diskon;
    }

    public function getTotalPriceAttribute()
    {
        //MENDAPATKAN TOTAL HARGA BARU YANG TELAH DIJUMLAHKAN DENGAN TAX (($this->total * $this->diskon) / 100)
        return (($this->total + (($this->total * 11) / 100)) - $this->diskon);
    }

    //DEFINE RELATIONSHIPS
    public function scopeAlertppn()
    {
        return $this->where('status', '0')->where('total', '!=', 0)->get();
    }

    public function customer()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Customer::class);
    }

    public function detailppn()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Invoice_detailppn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Product::class);
    }
    
     public function pengirimanppn()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Pengirimanppn::class);
    }
}

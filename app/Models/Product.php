<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Customer::class);
    }

    public function scopeProductalert()
    {
        return $this->where('stock', '<=', 0)->count();
    }

    public function invoice()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Invoice::class);
    }

    public function invoiceppn()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Invoiceppn::class);
    }

    public function product_detail()
    {
        //Invoice reference ke table customers
        return $this->hasMany(ProductDetail::class);
    }

    public function product_customer_detail()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Product_customer_detail::class);
    }
}

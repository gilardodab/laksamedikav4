<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_customer_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_customer()
    {
        return $this->hasMany(Invoice_customer_detail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(User::class);
    }
}

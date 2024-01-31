<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = "pengirimans";

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function detail()
    {
        return $this->belongsTo(Invoice_detail::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id');
    }

}

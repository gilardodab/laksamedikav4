<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengirimanppn extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoiceppn()
    {
        return $this->belongsTo(Invoiceppn::class);
    }

    public function detailppn()
    {
        return $this->belongsTo(Invoice_detailppn::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

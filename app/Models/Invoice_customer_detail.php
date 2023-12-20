<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_customer_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getSubtotalAttribute()
    {
        //NILAI DARI SUBTOTAL ADALAH QTY * PRICE kode diskon % -> (($this->qty * $this->price * $this->diskon) / 100))
        return number_format(($this->qty * $this->price) - $this->diskon);
    }

    public function invoice_customer()
    {
        return $this->belongsTo(Invoice_customer::class);
    }

    public function product_customer_detail()
    {
        return $this->belongsTo(Product_customer_detail::class);
    }

}

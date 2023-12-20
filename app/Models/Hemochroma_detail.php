<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hemochroma_detail extends Model
{
    use HasFactory;
    protected $dates = ['tanggal'];
    protected $guarded = [];
    public function hemochroma()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Hemochroma::class);
    }
}

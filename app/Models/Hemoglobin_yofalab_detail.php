<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hemoglobin_yofalab_detail extends Model
{
    use HasFactory;
    protected $dates = ['tanggal'];
    protected $guarded = [];
    public function hemoglobin_yofalab()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Hemoglobin_yofalab::class);
    }
}

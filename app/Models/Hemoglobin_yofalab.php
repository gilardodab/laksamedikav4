<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hemoglobin_yofalab extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function hemoglobin_yofalab_detail()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Hemoglobin_yofalab_detail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_kendaraan_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service_kendaraan()
    {
        return $this->belongsTo(Service_kendaraan::class);
    }
}

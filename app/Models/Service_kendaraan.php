<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_kendaraan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['tanggal'];

    public function service_kendaraan_detail()
    {
        return $this->hasMany(Service_kendaraan_detail::class);
    }
}

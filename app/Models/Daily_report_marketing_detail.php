<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_report_marketing_detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['tanggal'];
    public function daily_report_marketing()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Daily_report_marketing::class);
    }
}

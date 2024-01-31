<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_report_marketing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function daily_report_marketing_detail()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Daily_report_marketing_detail::class);
    }
    public function details()
{
    return $this->hasMany(Daily_report_marketing_detail::class, 'daily_report_marketing_id');
}
}

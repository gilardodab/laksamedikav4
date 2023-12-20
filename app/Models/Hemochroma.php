<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hemochroma extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function hemochroma_detail()
    {
        //Invoice reference ke table customers
        return $this->hasMany(Hemochroma_detail::class);
    }
}

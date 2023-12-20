<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

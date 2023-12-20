<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function soal_detail()
    {
        return $this->hasMany(Soal_detail::class);
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

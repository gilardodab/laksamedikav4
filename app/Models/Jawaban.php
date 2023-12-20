<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function soal_detail()
    {
        return $this->belongsTo(Soal_detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

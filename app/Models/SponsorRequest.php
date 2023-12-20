<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorRequest extends Model
{
    // app/Models/SponsorRequest.php
// app/Models/SponsorRequest.php

// app/Models/SponsorRequest.php

protected $fillable = [
    'user_id',
    'jenis_sponsor',
    'jumlah_rupiah',
    'waktu_kegiatan',
    'is_processed',
    'is_approved',
    'status',
];
}

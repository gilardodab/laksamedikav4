<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level',
        'address',
        'marketing',
        'jenis_institusi',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoiceppn()
    {
        return $this->hasMany(Invoiceppn::class);
    }

    public function call_plan()
    {
        return $this->hasMany(Call_plan::class);
    }
    
    public function penawaran()
    {
        return $this->hasMany(Penawaran::class);
    }

    public function invoice_customer()
    {
        return $this->hasMany(Invoice_customer::class);
    }

    public function product_customer_detail()
    {
        return $this->hasMany(Product_customer_detail::class);
    }
    
     public function soal_detail()
    {
        return $this->hasMany(Soal_detail::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}

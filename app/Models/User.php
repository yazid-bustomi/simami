<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded;

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

    public function alamat()
    {
        // relasi user hanya memiliki satu alamat di tabel alamat
        return $this->hasOne(Alamat::class);
    }

    public function jurusanKampus()
    {
        // relasi user memiliki satu jurusan
        return $this->hasMany(JurusanKampus::class);
    }

    public function mahasiswaProfile()
    {
        return $this->hasOne(MahasiswaProfile::class);
    }

    public function sosmed()
    {
        return $this->hasOne(Sosmed::class);
    }

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }

    public function akademikProfile()
    {
        return $this->hasOne(AkademikProfile::class, 'user_id');
    }

    public function adminKampus()
    {
        return $this->hasMany(AkademikProfile::class, 'admin_kampus_id');
    }
};



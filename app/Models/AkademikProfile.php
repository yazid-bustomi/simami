<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikProfile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adminKampus()
    {
        return $this->belongsTo(User::class, 'admin_kampus_id');
    }

    public function pengalaman()
    {
        return $this->hasMany(Pengalaman::class);
    }
}

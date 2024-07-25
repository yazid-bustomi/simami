<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaProfile extends Model
{
    use HasFactory;

    protected $guarded;
    protected $table = 'profiles';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

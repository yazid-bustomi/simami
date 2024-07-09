<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    use HasFactory;

    public function akademikProfile()
    {
        return $this->belongsTo(AkademikProfile::class);
    }
}

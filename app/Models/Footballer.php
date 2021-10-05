<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footballer extends Model
{
    use HasFactory;

    public function clubs()
    {
        return $this->belongsToMany(Club::class,'club_footballers');
    }
}

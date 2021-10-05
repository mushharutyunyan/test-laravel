<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function leagues()
    {
        return $this->belongsToMany(League::class,'league_clubs');
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class,'club_coaches');
    }

    public function footballers()
    {
        return $this->belongsToMany(Footballer::class,'club_footballers');
    }
}

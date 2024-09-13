<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'reports_to',
    ];

    public function position()
    {
    return $this->belongsTo(Position::class, 'reports_to');
    }

    public function positions()
    {
    return $this->hasMany(Position::class, 'reports_to');
    }
}

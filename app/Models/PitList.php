<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PitList extends Model
{
    use HasFactory;

    protected $fillable = [
        'signed',
        'list',
        'match_num',
        'event'
    ];

    protected $casts = [
        'list' => 'array',
    ];
}

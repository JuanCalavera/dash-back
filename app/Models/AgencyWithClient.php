<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyWithClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'agency'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pubpiece_id'
    ];

    public function pubPiece()
    {
        return $this->hasOne(PubPiece::class, 'id', 'pubpiece_id');
    }
}

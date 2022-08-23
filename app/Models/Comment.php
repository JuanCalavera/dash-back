<?php

namespace App\Models;

use App\Models\PubPiece\PubPiece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'pubpiece_id'
    ];

    public function pubPiece()
    {
        return $this->hasOne(PubPiece::class, 'id', 'pubpiece_id');
    }
}

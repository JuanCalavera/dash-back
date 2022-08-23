<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubPiece extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'title',
        'description',
        'deliver_date',
        'size',
        'files_path',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

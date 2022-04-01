<?php

namespace App\Models\PubPiece;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    protected $guarded = ['pub_piece_id'];

    public function pubPiece()
    {
        return $this->belongsTo(PubPiece::class);
    }
}

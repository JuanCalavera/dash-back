<?php

namespace App\Models\PubPiece;

use App\Models\Agency;
use App\Models\User;
use Database\Factories\PubPieceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubPiece extends Model
{
    use HasFactory;

    protected $fillable = ['was_liked', 'title', 'description'];

    protected $guarded = ['agency_id', 'file_url', 'file_type', 'user_id', 'pub_request_id'];

    protected static function newFactory()
    {
        return PubPieceFactory::new();
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}

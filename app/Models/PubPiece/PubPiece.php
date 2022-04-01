<?php

namespace App\Models\PubPiece;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubPiece extends Model
{
    use HasFactory;

    protected $fillable = ['was_liked', 'title', 'description'];

    protected $guarded = ['agency_id', 'image_url', 'user_id', 'pub_request_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
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

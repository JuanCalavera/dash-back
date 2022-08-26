<?php

namespace App\Models;

use App\Models\PubPiece\PubPiece;
use App\Models\PubRequest\PubRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cnpj',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pubRequests()
    {
        return $this->hasMany(PubRequest::class);
    }

    public function pubPieces()
    {
        return $this->hasMany(PubPiece::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}

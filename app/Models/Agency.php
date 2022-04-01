<?php

namespace App\Models;

use App\Models\AgencySettings\BudgetType;
use App\Models\AgencySettings\DrawType;
use App\Models\AgencySettings\Theme;
use App\Models\PubPiece\PubPiece;
use App\Models\PubRequest\PubRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['logo_path', 'theme_path', 'icon_path'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }

    public function drawTypes()
    {
        return $this->hasMany(DrawType::class);
    }

    public function budgetTypes()
    {
        return $this->hasMany(BudgetType::class);
    }

    public function pubRequests()
    {
        return $this->hasMany(PubRequest::class);
    }

    public function pubPieces()
    {
        return $this->hasMany(PubPiece::class);
    }
}
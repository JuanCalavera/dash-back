<?php

namespace App\Models\PubRequest;

use App\Models\Agency;
use App\Models\AgencySettings\DrawType;
use App\Models\AgencySettings\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubRequest extends Model
{
    use HasFactory;

    protected $fillable = ['deliver_date', 'size', 'description'];

    protected $guarded = ['agency_id', 'user_id', 'theme_id', 'draw_type_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }


    public function drawType()
    {
        return $this->belongsTo(DrawType::class);
    }
}

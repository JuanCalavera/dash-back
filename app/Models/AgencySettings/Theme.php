<?php

namespace App\Models\AgencySettings;

use App\Models\Agency;
use Database\Factories\ThemeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $guarded = ['agency_id'];

    protected static function newFactory()
    {
        return ThemeFactory::new();
    }

    public function agency()
    {
        $this->belongsTo(Agency::class);
    }
}

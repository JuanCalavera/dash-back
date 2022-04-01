<?php

namespace App\Models\AgencySettings;

use App\Models\Agency;
use Database\Factories\DrawTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $guarded = ['agency_id'];

    protected static function newFactory()
    {
        return DrawTypeFactory::new();
    }

    public function agency()
    {
        $this->belongsTo(Agency::class);
    }
}

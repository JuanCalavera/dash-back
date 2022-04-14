<?php

namespace App\Models\AgencySettings;

use App\Models\Agency;
use Database\Factories\PubTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubType extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'question'];

    protected $guarded = ['agency_id'];

    protected static function newFactory()
    {
        return PubTypeFactory::new();
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function subTypes()
    {
        return $this->hasMany(PubSubType::class);
    }
}

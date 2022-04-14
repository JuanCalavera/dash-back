<?php

namespace App\Models\AgencySettings;

use Database\Factories\PubSubTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubSubType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $guarded = ['agency_id'];

    protected static function newFactory()
    {
        return PubSubTypeFactory::new();
    }

    public function pubType()
    {
        return $this->belongsTo(PubType::class);
    }
}

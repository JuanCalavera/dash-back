<?php

namespace App\Models\AgencySettings;

use App\Models\Agency;
use App\Models\PubRequest\PubRequest;
use Database\Factories\BudgetTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $guarded = ['agency_id'];

    protected static function newFactory()
    {
        return BudgetTypeFactory::new();
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function pubRequests()
    {
        return $this->belongsToMany(PubRequest::class, 'budget_types_on')->withTimestamps();
    }
}

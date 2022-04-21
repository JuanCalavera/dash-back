<?php

namespace App\Models\PubRequest;

use App\Models\Agency;
use App\Models\AgencySettings\BudgetType;
use App\Models\AgencySettings\PubSubType;
use App\Models\AgencySettings\PubType;
use App\Models\User;
use Database\Factories\PubRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubRequest extends Model
{
    use HasFactory;

    protected $fillable = ['deliver_date', 'size', 'description', 'exhibition_description'];

    protected $guarded = ['agency_id', 'user_id', 'pub_type_id', 'pub_sub_type_id'];

    protected static function newFactory()
    {
        return PubRequestFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function pubType()
    {
        return $this->belongsTo(PubType::class);
    }

    public function pubSubType()
    {
        return $this->belongsTo(PubSubType::class);
    }

    public function budgetTypes()
    {
        return $this->belongsToMany(BudgetType::class, 'budget_types_on')->withTimestamps();
    }
}

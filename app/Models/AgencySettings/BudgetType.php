<?php

namespace App\Models\AgencySettings;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $guarded = ['agency_id'];

    public function agency()
    {
        $this->belongsTo(Agency::class);
    }
}

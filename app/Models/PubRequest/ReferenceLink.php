<?php

namespace App\Models\PubRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceLink extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    protected $guarded = ['pub_request_id'];

    public function pubRequest()
    {
        return $this->belongsTo(PubRequest::class);
    }
}

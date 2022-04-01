<?php

namespace App\Models\PubRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceFile extends Model
{
    use HasFactory;

    protected $fillable = ['is_image'];

    protected $guarded = ['file_path', 'pub_request_id'];

    public function pubRequest()
    {
        return $this->belongsTo(PubRequest::class);
    }
}

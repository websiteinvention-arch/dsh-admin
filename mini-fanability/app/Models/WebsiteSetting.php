<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'website_id',
        'logo',
        'white_logo',
        'favicon',
        'email',
        'phone',
        'address',
        'domain',
        'destination_url',
        'youtube',
        'instagram',
        'linkedin',
        'facebook',
        'twitter',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
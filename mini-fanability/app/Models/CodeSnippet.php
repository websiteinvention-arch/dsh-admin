<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeSnippet extends Model
{
    protected $fillable = [
        'website_id',
        'name',
        'slug',
        'code',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
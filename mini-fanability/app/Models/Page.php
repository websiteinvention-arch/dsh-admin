<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'website_id',
        'page_name',
        'slug',
        'page_content',
        'browser_title',
        'meta_keywords',
        'page_keyword',
        'meta_description',
        'page_image',
        'text_variable',
        'include_in_head',
        'include_in_footer',
        'template_file',
        'status',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
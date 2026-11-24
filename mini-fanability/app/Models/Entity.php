<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'name',
        'slug',
        'description',
        'status',
    ];


    public function website()
{
    return $this->belongsTo(Website::class);
}

public function fields()
{
    return $this->hasMany(EntityField::class);
}

public function records()
{
    return $this->hasMany(EntityRecord::class);
}
}


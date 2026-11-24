<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityRecord extends Model
{
    protected $fillable = [
        'entity_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function values()
    {
        return $this->hasMany(EntityRecordValue::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityRecordValue extends Model
{
    protected $fillable = [
        'entity_record_id',
        'entity_field_id',
        'value',
    ];

    public function record()
    {
        return $this->belongsTo(EntityRecord::class, 'entity_record_id');
    }

    public function field()
    {
        return $this->belongsTo(EntityField::class, 'entity_field_id');
    }
}
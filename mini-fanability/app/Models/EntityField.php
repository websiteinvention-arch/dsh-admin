<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityField extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'field_name',
        'field_type',
        'is_required',
        'sort_order',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
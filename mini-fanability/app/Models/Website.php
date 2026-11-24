<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Website extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'project_name',
        'email',
        'password',
        'description',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
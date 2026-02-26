<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardControl extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'AccessLevel',
        'route',
        'order'
    ];
    
            protected $casts = [
                 'name' => 'string',
                'description' => 'string',
                'AccessLevel' => 'string',
                'route' => 'string',
                'order' => 'integer',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',

        ];
}
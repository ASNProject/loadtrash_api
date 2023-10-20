<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_type',
        'weight',
        'credit',
    ];
}

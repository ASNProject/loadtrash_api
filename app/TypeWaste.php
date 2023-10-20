<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeWaste extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_type',
        'type',
        'price',
    ];
}

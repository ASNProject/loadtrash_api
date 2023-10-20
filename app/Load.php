<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'code',
        'password',
        'value',
    ];
}

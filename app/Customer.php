<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_user',
        'name',
        'password',
        'address',
        'id_number',
        'registration',
        'id_status',
        'id_load',
    ];

}

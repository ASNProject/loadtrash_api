<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_status',
        'status',
    ];
}

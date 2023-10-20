<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_user',
        'debit',
        'status_withdrawal',
        'date_withdrawal',
    ];
}

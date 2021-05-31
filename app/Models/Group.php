<?php

namespace App\Models;

use Jenssegers\Model\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uniqueId',
        'totalPrice',
        'outbound',
        'inbound',
    ];
}

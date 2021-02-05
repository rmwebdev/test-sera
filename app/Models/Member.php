<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class Member extends Model
{
    
    protected $connection = 'mongodb_conn';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','address'
    ];

}

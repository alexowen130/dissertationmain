<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Model for Eloquent to conect to table in DB
class User extends Model
{
    //Only columns added here can be used to update DB with user information
    protected $fillable = [

        'username',
        'password',
    ];

}

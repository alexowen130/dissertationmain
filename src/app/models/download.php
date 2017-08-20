<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Model for Eloquent to conect to table in DB
class Download extends Model
{

	protected $table = 'downloads';

    //Only columns added here can be used to update DB with user information
    protected $fillable = [

        'filename',
        'filetype',
        'filelocation',
        'lintresult',

    ];

}
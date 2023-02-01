<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    //
         use SoftDeletes;
    
    protected $table = 'division';
 
    protected $fillable = [
        'name', 'hash_id',
    ];
}

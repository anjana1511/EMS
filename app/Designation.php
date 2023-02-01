<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'designation';
 
    protected $fillable = [
        'name', 'hash_id',
    ];
}

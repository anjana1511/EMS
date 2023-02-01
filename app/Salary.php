<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    //
     use SoftDeletes;
    
    protected $table = 'salary';
 
    protected $fillable = [
        'gross_salary','tax','emp_id', 'hash_id',
    ];
}

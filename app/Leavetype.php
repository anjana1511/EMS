<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leavetype extends Model
{
    //
         use SoftDeletes;
    
    protected $table = 'leavetype';
 
    protected $fillable = [
        'leave_type', 'hash_id',
    ];

    public function leaveapply()
    {
        return $this->hasMany('App\Empleave');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class State extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'states';
 
    protected $fillable = [
        'state_name', 'hash_id',
    ];


  
    public function districts()
    {
        return $this->hasMany('App\District');
    }
    
    public function talukas()
    {
        return $this->hasMany('App\Taluka');
    }

    
}

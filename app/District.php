<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class District extends Model
{
    //

    use SoftDeletes;
    
    protected $table = 'districts';
 

    protected $fillable = [
        'district_name', 'hash_id','state_id',
    ];


  

    public function states() {

   return $this->belongsTo('App\State');
       
   }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Taluka extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'talukas';
 
    protected $fillable = [
        'taluka_name', 'hash_id','dist_id','state_id'
    ];

    
    public function states()
    {
        return $this->belongsTo('App\State');
    }

    
    public function districts()
    {
        return $this->belongsTo('App\District');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Village extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'village';
    
    protected $fillable = [
        'village_name','hash_id','dist_id','state_id','taluka_id'
    ];
}

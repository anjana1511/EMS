<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //

    use SoftDeletes;
    
    protected $table = 'projects';
 

    protected $fillable = [
        'pname', 'hash_id','details','dept_id','status'
    ];

    public function department() {

   return $this->belongsTo('App\Department');
       
   }

   
   public function project_assign()
   {
       return $this->hasMany('App\ProjectAssign');
   }
}

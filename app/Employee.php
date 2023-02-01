<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'employee';
 
    protected $fillable = [
         'hash_id','firstname','middlename','village_id','taluka_id','dist_id','state_id','dept','divi_id','salary','age','dob','join_date','Mono','email'
    ];

    
    public function project_assign()
    {
        return $this->hasMany('App\ProjectAssign');
    }

    public function leaveapply()
    {
        return $this->hasMany('App\Empleave');
    }

}

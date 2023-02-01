<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectAssign extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'project_assign';
 

    protected $fillable = [
        'id','hash_id','p_id','dept_id','emp_id','status'
    ];

    public function project() {

        return $this->belongsTo('App\Project');
            
        }
    public function department() {

   return $this->belongsTo('App\Department');
       
   }

   public function employee() {

    return $this->belongsTo('App\Employee');
        
    }
}

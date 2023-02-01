<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
    //
     use SoftDeletes;
    
    protected $table = 'department';
 
    protected $fillable = [
        'dept_name', 'hash_id',
    ];

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    
    public function project_assign()
    {
        return $this->hasMany('App\ProjectAssign');
    }
    

}

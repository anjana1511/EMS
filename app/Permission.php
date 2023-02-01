<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    //
    use SoftDeletes;
    protected $table = 'permissions';
 
    protected $fillable = [
      'per_name', 'slug',
  ];

    
    public function roles() {

   return $this->belongsToMany(Role::class,'roles_permissions');
       
}

public function users() {

   return $this->belongsToMany(User::class,'users_permissions');
       
}
}

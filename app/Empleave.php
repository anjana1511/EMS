<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleave extends Model
{
    //
    use SoftDeletes;

    protected $table='empleave';

    protected $fillable=[
    	'hash_id','emp_id','l_id','leave_fromdate','leave_todate','leave_description','leave_status','admin_remark'];


        public function employee() {

            return $this->belongsTo('App\Employee');
                
            }

            public function leavetype() {

                return $this->belongsTo('App\LeaveType');
                    
                }
 }

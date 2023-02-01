<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Managesalary extends Model
{
    //
    protected $table='manage_salary';
    protected $fillable = [
        'emp_id', 'working_days','gross_salary','tax',
    ];
    public function users()
    {
        return $this->belongsTo('App\Employee','emp_id');
    }
    public function advanceSum()
    {
        return $this->hasMany('App\Advancepayment')
            ->selectRaw('SUM(amount) as total')
            ->groupBy('employee_id');
    }
}

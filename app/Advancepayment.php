<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Advancepayment extends Model
{
    use SoftDeletes;
    //
    protected $table='advance_payment';
    protected $fillable = [
        'emp_id', 'date','amount',
    ];
    public function users()
    {
        return $this->belongsTo('App\Employee','emp_id');
    }
}

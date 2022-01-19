<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected   $table      = 'charge';
    protected   $primaryKey = 'id';
    protected   $fillable   = [ 'payment_id', 'amount' ];
    public      $timestamps = false;
}

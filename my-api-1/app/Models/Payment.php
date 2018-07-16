<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected   $table      = 'payment';
    protected   $primaryKey = 'id';
    protected   $fillable   = [ 'name', 'type', 'iban', 'expiry', 'cc', 'ccv' ];
    public      $timestamps = false;
    
    /**
     * Get the comments for the blog post.
     */
    public function charges()
    {
        return $this->hasMany('App\Models\Charge');
    }
}

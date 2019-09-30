<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedContact extends Model
{
    protected $fillable = ['user_id', 'contact_id'];
    
    /**
     * Get the user that owns the contact.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

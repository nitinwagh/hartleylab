<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['user_id', 'first_name', 'middle_name', 'last_name', 'primary_number', 'secondary_number', 'email', 'image_path'];

    /**
     * Get the user that owns the contact.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the user that owns the contact.
    */
    public function sharedContact()
    {
        return $this->belongsTo(SharedContact::class);
    }
}

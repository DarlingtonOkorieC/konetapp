<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bio', 'phone', 'dob', 'gender', 'passport', 'twitter', 'linkedin', 'country_id', 'state_id', 'city_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

// emerwhmy_
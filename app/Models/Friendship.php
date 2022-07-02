<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;
    
    public function isFriendFirstUser() {
        return $this->hasOne(User::class,'id','first_user');
    }
    public function isFriendSecondUser() {
        return $this->hasOne(User::class,'id','second_user');
    }
}

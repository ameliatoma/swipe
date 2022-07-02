<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

        /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id', 
        'book_id',
        'score',
        'comment'
    ];
    public $timestamps = false;
    public function reviewer() {
        return $this->hasOne(User::class,'id','user_id');
    }
}

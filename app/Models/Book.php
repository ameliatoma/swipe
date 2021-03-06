<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'image_url',
    ];

    public function isLiked() {
        return $this->hasOne(Library::class, 'book_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    protected $table = 'bookshelves';
    protected $primaryKey = 'id';
    public $fillable = ['user_id', 'title'];

    public function categories(){
        return $this->belongsToMany(Category::class, 'bookshelves_has_categories');
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'bookshelves_has_books');
    }
}



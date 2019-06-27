<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'category_id', 'title', 'comment', 'img_name'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookshelves(){
        return $this->belongsToMany(Bookshelf::class, 'bookshelves_has_books');
    }

    public function likeUsers(){
        return $this->belongsToMany(User::class, 'likes');
    }

    public function likedBook(){
        return $this->belongsToMany(self::class, 'likes');
    }

    public function liked(){
        $search = $this->likeUsers->search(function ($liked){
            return $liked->pivot->user_id === auth()->user()->id;
        });

        return $search !== false;
    }

}

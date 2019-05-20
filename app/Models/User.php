<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password', 'img_name'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function bookshelves()
    {
        return $this->hasMany(Bookshelf::class);
    }

    public function likedBooks()
    {
        return $this->belongsToMany(Book::class, 'likes');
    }

    public function likes()
    {
        return $this->belongsToMany(self::class, 'likes', 'user_id', 'book_id');
    }

    public function TemporaryUser()
    {
        return $this->hasOne(TemporaryUser::class);
    }

    public function store($request)
    {
        if ($request->hasFile('img_name')) {
            $realPath = $request->img_name->getRealPath();
            $filename = hash_file('sha256', $realPath);
            $extension = $request->img_name->getClientOriginalExtension();
            $filename = "$filename.$extension";
            if (self::where('img_name', $filename)->doesntExist()) {
                $request->img_name->storeAs('public/user_images', $filename);
            }
            $this->img_name = $filename;
        }

        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = Hash::make($request->password);

        $this->save();
    }

    public function passwordUpdate($request)
    {
        $this->password = Hash::make($request->password);
        $this->save();
    }
}

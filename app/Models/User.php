<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function store($request)
    {
        if ($request->hasFile('img_name')) {
            $path = $request->img_name->store('public/user_images');
            $filename = pathinfo($path, PATHINFO_BASENAME);
            $this->img_name = $filename;
        }

        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = Hash::make($request->password);

        $this->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryUser extends Model
{
    protected $table = 'temporary_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'email', 'token', 'created_at'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

}

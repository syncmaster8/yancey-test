<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Store;
use App\Models\UserType;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'type_id',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function usertype()
    {
        return $this->belongsTo(UserType::class,'type_id','id');
    }
}

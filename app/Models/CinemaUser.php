<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaUser extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    protected $table = 'cinema_users';
    public $timestamps = false;

    protected $fillable = ['name', 'email','birth_day', 'password'];
}

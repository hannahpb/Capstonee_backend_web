<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserAccount extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "useraccount";
    protected $fillable = [
        'username',
        'fname',
        'lname',
        'email',
        'password',
    ];
}

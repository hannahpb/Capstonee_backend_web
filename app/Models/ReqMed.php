<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ReqMed extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "reqmed";
    protected $fillable = [
        'fname',
        'lname',
        'verdict',
        'uid',
    ];
}

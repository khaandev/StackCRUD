<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCrud extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'image',
        'status',
        'role',

    ];
}

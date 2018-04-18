<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usersocial extends Model
{
     protected $table  = 'user_socail';

     protected $fillable =[
        'nickname',
        'email',
        'avatar'
     ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasusIt extends Model
{
    protected $fillable = ['user_id', 'kasus', 'solusi', 'kasus_olahan'];
}

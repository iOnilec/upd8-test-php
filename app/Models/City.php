<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'city_id',
        'city_name',
        'city_uf',
    ];

    protected $primaryKey = 'city_id';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $table = 'representatives';

    protected $fillable = [
        'representative_id',
        'representative_name',
        'representative_email',
        'representative_phone',

        # FK
        'city_id',
    ];

    protected $primaryKey = 'representative_id';
}

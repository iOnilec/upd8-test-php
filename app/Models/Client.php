<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'client_id',
        'client_name',
        'client_address',
        // 'client_state',
        // 'client_city',
        'client_cpf',
        'client_sex',

        # FK
        'city_id',
    ];

    protected $primaryKey = 'client_id';
}

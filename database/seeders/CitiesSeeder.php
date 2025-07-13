<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::updateOrInsert([
            'city_name' => 'Campinas',
            'city_uf' => 'SP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'São Paulo',
            'city_uf' => 'SP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Salto',
            'city_uf' => 'SP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Rio de Janeiro',
            'city_uf' => 'RJ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Belo Horizonte',
            'city_uf' => 'MG',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Curitiba',
            'city_uf' => 'PR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Florianópolis',
            'city_uf' => 'SC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Fortaleza',
            'city_uf' => 'CE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Manaus',
            'city_uf' => 'AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Porto Alegre',
            'city_uf' => 'RS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Goiânia',
            'city_uf' => 'GO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        City::updateOrInsert([
            'city_name' => 'Recife',
            'city_uf' => 'PE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

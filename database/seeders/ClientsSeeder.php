<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::updateOrInsert(
            ['client_cpf' => '123.456.789-09'],
            [
                'client_name' => 'Maria da Silva',
                'client_address' => 'Rua das Flores, 123',
                # 'client_state' => 'SP',
                # 'client_city' => 'Campinas',
                'client_sex' => 'F',
                'city_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Client::updateOrInsert(
            ['client_cpf' => '987.654.321-00'],
            [
                'client_name' => 'João Souza',
                'client_address' => 'Av. Brasil, 456',
                # 'client_state' => 'RJ',
                # 'client_city' => 'Rio de Janeiro',
                'client_sex' => 'M',
                'city_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Client::updateOrInsert(
            ['client_cpf' => '321.654.987-01'],
            [
                'client_name' => 'Ana Oliveira',
                'client_address' => 'Rua das Acácias, 789',
                # 'client_state' => 'MG',
                # 'client_city' => 'Belo Horizonte',
                'client_sex' => 'F',
                'city_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Client::updateOrInsert(
            ['client_cpf' => '111.222.333-44'],
            [
                'client_name' => 'Carlos Pereira',
                'client_address' => 'Rua Central, 111',
                # 'client_state' => 'RS',
                # 'client_city' => 'Porto Alegre',
                'client_sex' => 'M',
                'city_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Client::updateOrInsert(
            ['client_cpf' => '555.666.777-88'],
            [
                'client_name' => 'Beatriz Santos',
                'client_address' => 'Rua Nova, 222',
                # 'client_state' => 'PR',
                # 'client_city' => 'Curitiba',
                'client_sex' => 'F',
                'city_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Client::updateOrInsert(
            ['client_cpf' => '999.888.777-66'],
            [
                'client_name' => 'Lucas Lima',
                'client_address' => 'Alameda das Palmeiras, 333',
                # 'client_state' => 'BA',
                # 'client_city' => 'Salvador',
                'client_sex' => 'M',
                'city_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}

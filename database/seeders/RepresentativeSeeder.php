<?php

namespace Database\Seeders;

use App\Models\Representative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Representative::updateOrInsert([
            'representative_name' => 'Maria Aparecida',
            'representative_email' => 'maria.aparecida@example.com',
            'representative_phone' => '(11) 91234-5678',
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Representative::updateOrInsert([
            'representative_name' => 'João Silva',
            'representative_email' => 'joao.silva@example.com',
            'representative_phone' => '(11) 98765-4321',
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Representative::updateOrInsert([
            'representative_name' => 'Ana Souza',
            'representative_email' => 'ana.souza@example.com',
            'representative_phone' => '(11) 93456-7890',
            'city_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Representative::updateOrInsert([
            'representative_name' => 'Carlos Pereira',
            'representative_email' => 'carlos.pereira@example.com',
            'representative_phone' => '(11) 94567-1234',
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Representative::updateOrInsert([
            'representative_name' => 'Fernanda Lima',
            'representative_email' => 'fernanda.lima@example.com',
            'representative_phone' => '(11) 95678-2345',
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Representative::updateOrInsert([
            'representative_name' => 'Ricardo Gonçalves',
            'representative_email' => 'ricardo.goncalves@example.com',
            'representative_phone' => '(11) 96789-3456',
            'city_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

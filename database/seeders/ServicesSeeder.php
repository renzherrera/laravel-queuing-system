<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'department_id' => '1',
            'name' => 'Service 1',
            'prefix' => 'S1',
            'default_number' => 100,
            'avg_time_waiting' => 5,
            'is_active' => 1,

        ]);
    }
}

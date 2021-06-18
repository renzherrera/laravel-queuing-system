<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Counter::create([
            'counter_name' => 'Counter 1',
            'service_id' => 1,
            'is_active' => 1,
        ]);
    }
}

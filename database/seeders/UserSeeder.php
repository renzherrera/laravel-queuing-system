<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            //password already hashed in the model properties
            'password' => 'admin1234',
            'is_admin' => 1,
            'is_active' => 1,
            'is_loggedin' => 0,
            'counter_id' => 1,

        ]);
    }
}

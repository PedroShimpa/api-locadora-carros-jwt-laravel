<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        return $user->create([
            'name' => 'Pedro',
            'email' => 'teste@locadora.com',
            'password' => bcrypt('123456')
        ]);
        
    }
}

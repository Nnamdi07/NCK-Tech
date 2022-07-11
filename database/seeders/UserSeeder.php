<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Favour';
        $user->email = 'favour@nck.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('secret');
        $user->type = 'Admin';
        $user->save(); 
    }
}

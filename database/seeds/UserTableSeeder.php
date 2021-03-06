<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create(array('name' => 'Administrator',
                           'email' => 'admin@watchme.com', 
                           'password' => bcrypt('secret'),
                           'role' => 'admin'));
    }
}

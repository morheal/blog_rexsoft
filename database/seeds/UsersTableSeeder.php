<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::insert(['name' => 'user', 'email' => 'user@mail.com', 'password' => bcrypt('111111'), 'subscribe' => false, 'is_admin' => false, 'is_banned' => false]);
      User::insert(['name' => 'admin', 'email' => 'admin@mail.com', 'password' => bcrypt('111111'), 'subscribe' => false, 'is_admin' => true, 'is_banned' => false]);
    }
}

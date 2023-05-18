<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $user = new User;
        $user ->name = 'ESteban';
        $user ->email = 'valles.780@hotmail.com';
        $user ->password = bcrypt('123456');
        $user ->save();
    }
}

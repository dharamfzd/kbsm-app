<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>'Admin',
            'email'=>'admin.@gmail.com',
            'password'=> bcrypt('12345678'),
            'is_role' => 2,
        ];
        User::create($data);
    }
}

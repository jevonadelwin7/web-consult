<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'SuperAdmin',
               'email'=>'suadmin@hotmail.com',
                'is_admin'=>'1',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Regular User',
               'email'=>'reguser@gmail.com',
                'is_admin'=>'0',
               'password'=> bcrypt('07070707'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

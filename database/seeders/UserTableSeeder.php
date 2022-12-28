<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /*$p1 = new User;
        $p1->username = "tomBlaine";
        $p1->password = "password";
        $p1->name = "Thomas Blaine";
        $p1->email = "2033755@swansea.ac.uk";
        $p1->save();
        */
        User::factory()->count(50)->create();

    }
}

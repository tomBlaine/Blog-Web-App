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
        $p1 = new User;
        $p1->username = "tomBlaine";
        $p1->password = "password";
        $p1->firstname = "Thomas";
        $p1->lastname = "Blaine";
        $p1->email = "2033755@swansea.ac.uk";
        $p1->DOB = '2002-05-16';
        $p1->save();
        App/Models/User::factory()->count(50)->create();

    }
}

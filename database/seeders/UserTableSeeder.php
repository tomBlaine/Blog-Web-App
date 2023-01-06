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
        $p1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $p1->privileges = 2;
        $p1->name = "Thomas Blaine";
        $p1->email = "2033755@swansea.ac.uk";
        $p1->save();

        $p2 = new User;
        $p2->username = "lisa1122";
        $p2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $p2->privileges = 1;
        $p2->name = "Lisa Blaine";
        $p2->email = "lisa@swansea.ac.uk";
        $p2->save();
        
        User::factory()->count(50)->create();

    }
}

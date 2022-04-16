<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ClimbingRegistration;
use App\Models\Mountain;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@mountdaki.com',
            'password' => bcrypt('admin123'),
        ]);
    
        User::create([
            'name' => 'Muhammad Ikhsanudin',
            'email' => 'ikhsan@gmail.com',
            'password' => bcrypt('ikhsan123'),
        ]);

        User::create([
            'name' => 'Agil Fachrian',
            'email' => 'agil@gmail.com',
            'password' => bcrypt('agil123'),
        ]);

        User::create([
            'name' => 'Bagas Wara',
            'email' => 'bagas@gmail.com',
            'password' => bcrypt('bagas123'),
        ]);

        User::create([
            'name' => 'Rifqi Ramadhan',
            'email' => 'rifqi@gmail.com',
            'password' => bcrypt('rifqi123'),
        ]);

        Mountain::create([
            'name' => 'Gunung Lawu',
            'image' => 'lawu.png',
            'description' => 'Gunung Lawu terletak di Pulau Jawa, Indonesia, tepatnya di perbatasan Provinsi Jawa Tengah dan Jawa Timur. Gunung Lawu terletak di antara tiga kabupaten yaitu Kabupaten Karanganyar, Jawa Tengah, Kabupaten Ngawi, dan Kabupaten Magetan, Jawa Timur.',
            'location' => 'Jawa Tengah',
            'height' => 3265,
            'rate' => 0,
            'basecamp' => 5,
        ]);

        Mountain::create([
            'name' => 'Gunung Semeru',
            'image' => 'semeru.png',
            'description' => 'Semeru, or Mount Semeru, is an active volcano in East Java, Indonesia. It is located in a subduction zone, where the Indo-Australian plate subducts under the Eurasia plate. It is the highest mountain on the island of Java',
            'height' => 3676,
            'location' => 'Jawa Timur',
            'rate' => 0,
            'basecamp' => 4,
        ]);

        ClimbingRegistration::create([
            'mountain_id' => 1,
            'user_id' => 1,
            'identity_card' => 'no-image.png',
            'healthy_letter' => 'no-image.png',
            'schedule' => Carbon::create(2022, 4, 17)
        ]);

        ClimbingRegistration::create([
            'mountain_id' => 2,
            'user_id' => 2,
            'identity_card' => 'no-image.png',
            'healthy_letter' => 'no-image.png',
            'schedule' => Carbon::create(2022, 4, 18)
        ]);
    }
}

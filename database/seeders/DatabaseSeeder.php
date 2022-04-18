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
            'image' => 'Gunung Lawu.jpg',
            'description' => 'Gunung Lawu terletak di Pulau Jawa, Indonesia, tepatnya di perbatasan Provinsi Jawa Tengah dan Jawa Timur. Gunung Lawu terletak di antara tiga kabupaten yaitu Kabupaten Karanganyar, Jawa Tengah, Kabupaten Ngawi, dan Kabupaten Magetan, Jawa Timur.',
            'location' => 'Jawa Tengah',
            'height' => 3265,
            'basecamp' => 5,
        ]);

        Mountain::create([
            'name' => 'Gunung Semeru',
            'image' => 'Gunung Semeru.jpg',
            'description' => 'Gunung Semeru atau Gunung Meru adalah sebuah gunung berapi kerucut di Jawa Timur, Indonesia. ',
            'height' => 3676,
            'location' => 'Jawa Timur',
            'basecamp' => 4,
        ]);
    }
}

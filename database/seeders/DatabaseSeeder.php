<?php

use Illuminate\Database\Seeder;
use App\Domains\Auth\Database\Seeds\UserSeeder;
use App\Domains\Setting\Database\Seeds\BlogSeeder;
use App\Domains\Setting\Database\Seeds\SettingSeeder;
use App\Domains\General\Database\Seeds\CategorySeeder;
use App\Domains\Auth\Database\Seeds\RoleAndPremissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPremissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
        ]);
    }
}

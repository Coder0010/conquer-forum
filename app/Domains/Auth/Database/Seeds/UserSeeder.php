<?php

namespace App\Domains\Auth\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domains\Auth\Entities\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("users")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("providers")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("password_resets")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        User::create([
            "status"            => config("system.status.active"),
            "name"              => config("system.developer.name"),
            "email"             => config("system.developer.email"),
            "phone"             => config("system.developer.phone"),
            "password"          => config("system.developer.password"),
            "email_verified_at" => now(),
        ]);
        User::create([
            "status"            => config("system.status.active"),
            "name"              => config("system.company.name"),
            "email"             => config("system.company.email"),
            "phone"             => config("system.company.phone"),
            "password"          => config("system.company.password"),
            "email_verified_at" => now(),
        ]);
        foreach (["sub_manager", "admin", "normal"] as $item) {
            User::create([
                "status"            => config("system.status.active"),
                "name"              => $item,
                "email"             => "{$item}@yahoo.com",
                "password"          => config("system.default_password"),
                "email_verified_at" => now(),
            ]);
        }
    }
}

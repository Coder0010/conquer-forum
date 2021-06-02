<?php

namespace App\Domains\General\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\General\Entities\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("brands")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $data = [];
        for ($i=0; $i < 5; $i++) {
            if ($i % 2 != 0) {
                $is_promoted = config("system.answers.yes");
                $status      = config("system.status.active");
            } else {
                $is_promoted = config("system.answers.no");
                $status      = config("system.status.deactivate");
            }
            $data []= [
                "name_en"        => "Brand [EN] ( {$i} )",
                "name_ar"        => "Brand [AR] ( {$i} )",
                "data" =>[
                    "description_en" => "Description [EN] ( {$i} )",
                    "description_ar" => "Description [AR] ( {$i} )",
                ],
                "order"       => $i,
                "status"      => $status,
            ];
        }
        foreach ($data as $item) {
            Brand::create($item);
        }
    }
}

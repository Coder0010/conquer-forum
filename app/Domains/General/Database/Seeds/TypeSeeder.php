<?php

namespace App\Domains\General\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\General\Entities\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("types")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        $types = [];
        $subtypes = [];
        for ($g = 0; $g < 5; $g++) {
            if ($g % 2 != 0) {
                $is_promoted = config("system.answers.yes");
                $status      = config("system.status.active");
            } else {
                $is_promoted = config("system.answers.no");
                $status      = config("system.status.deactivate");
            }
            $types [] = [
                "name_en" => "Grand Parent-Type-{$g}",
                "name_ar" => "Grand Parent-Type-{$g}",
                "order"       => $g,
                "status"      => $status,
            ];
            for ($p = 0; $p < 5; $p++) {
                $grand = $g + 1;
                $subtypes [] = [
                    "name_en"   => "Parent-Type-{$grand}.{$p}",
                    "name_ar"   => "Parent-Type-{$grand}.{$p}",
                    "parent_id" => $grand,
                    "order"       => $g,
                    "status"      => $status,
                ];
            }
        }
        $total = array_merge($types, $subtypes);
        foreach ($total as $item) {
            Type::create($item);
        }
    }
}

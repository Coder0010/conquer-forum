<?php

namespace App\Domains\General\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\General\Entities\Categories\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("categories")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        $categories = [];
        $sub_categories = [];
        $sub_category_types = [];

        for ($g = 0; $g < 5; $g++) {
            if ($g % 2 != 0) {
                $is_promoted = config("system.answers.yes");
                $status      = config("system.status.active");
            } else {
                $is_promoted = config("system.answers.no");
                $status      = config("system.status.deactivate");
            }
            $categories [] = [
                "name_en" => "Grand Parent-{$g}",
                "name_ar" => "Grand Parent-{$g}",
                "order"   => $g,
                "status"  => $status,
            ];
            for ($p = 0; $p < 5; $p++) {
                $grand = $g + 1;
                $sub_categories [] = [
                    "name_en"   => "Parent-{$grand}.{$p}",
                    "name_ar"   => "Parent-{$grand}.{$p}",
                    "parent_id" => $grand,
                    "order"     => $g,
                    "status"    => $status,
                ];
                for ($c = 0; $c < 5; $c++) {
                    $parent = $p + 10;
                    $sub_category_types [] = [
                        "name_en"   => "Child-{$grand}.{$parent}.{$c}",
                        "name_ar"   => "Child-{$grand}.{$parent}.{$c}",
                        "child_id"  => $parent,
                        "order"     => $g,
                        "status"    => $status,
                    ];
                }
            }
        }
        $total = array_merge($categories, $sub_categories, $sub_category_types);
        foreach ($total as $item) {
            Category::create($item);
        }
    }
}

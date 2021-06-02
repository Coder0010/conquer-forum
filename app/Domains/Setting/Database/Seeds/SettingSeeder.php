<?php

namespace App\Domains\Setting\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\Setting\Entities\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("settings")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        $general = [
            [
                "key" => "name",
                "data" => "conquer-forum",
            ],
            [
                "key" => "description",
                "data" => "website description en",
            ],
            [
                "key" => "keywords",
                "data" => "conquer-forum",
            ],
        ];

        $navbar = [
            [
                "key" => "navbar_trans_home",
                "data" => "Home",
            ],
            [
                "key" => "navbar_trans_about_us",
                "data" => "About us",
            ],
            [
                "key" => "navbar_trans_contact_us",
                "data" => "Contact us",
            ],
        ];

        $social = [
            [
                "key" => "facebook",
                "data" => "https://www.facebook.com",
            ],
            [
                "key" => "instagram",
                "data" => "https://www.instagram.com",
            ],
            [
                "key" => "twitter",
                "data" => "https://twitter.com",
            ],
            [
                "key" => "linkedin",
                "data" => "https://www.linkedin.com",
            ],
            [
                "key" => "youtube",
                "data" => "https://www.youtube.com",
            ],
        ];

        $contactUs = [
            [
                "key" => "map_address",
                "data" => "map_address",
            ],
            [
                "key" => "map_lat",
                "data" => "30.0510093",
            ],
            [
                "key" => "map_lng",
                "data" => "31.349499700000024",
            ],
            [
                "key" => "phone",
                "data" => "01122002864",
            ],
            [
                "key" => "email",
                "data" => "support@conquer-forum.com",
            ],
        ];

        $contactUsHeader = [
            [
                "key"  => "contact_us_title",
                "data" => "contact us title",
            ],
            [
                "key"  => "contact_us_description",
                "data" => "contact us description",
            ],
        ];

        $aboutUsHeader = [
            [
                "key"  => "about_us_title",
                "data" => "about us title",
            ],
            [
                "key"  => "about_us_description",
                "data" => "about us description",
            ],
        ];

        $mutli = array_merge(
            $general,
            $navbar,
            $aboutUsHeader,
            $contactUsHeader,
        );
        $multi_lang_data = [];
        foreach ($mutli as $item) {
            foreach (AppLanguages() as $lang) {
                $multi_lang_data[] = [
                    "key"  => $item["key"]."_".$lang,
                    "data" => $item["data"],
                ];
            }
        }

        $normal_data = [
            [
                "key"  => "theme",
                "data" => "theme_2",
            ],
        ];
        $normal_data = array_merge(
            $normal_data,
            $contactUs,
            $social,
        );

        $settings = array_merge($multi_lang_data, $normal_data, );
        foreach ($settings as $data) {
            Setting::create($data);
        }
    }
}

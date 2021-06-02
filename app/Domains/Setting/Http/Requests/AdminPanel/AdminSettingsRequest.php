<?php

namespace App\Domains\Setting\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $general = [
            "name_en"        => "required",
            "name_ar"        => "sometimes|nullable",
            "keywords_en"    => "required",
            "keywords_ar"    => "sometimes|nullable",
            "logo_en"        => "required",
            "logo_ar"        => "sometimes|nullable",
            "favicon_en"     => "required",
            "favicon_ar"     => "sometimes|nullable",
        ];

        $navbar = [
            "navbar_trans_home_en"        => "required",
            "navbar_trans_home_ar"        => "sometimes|nullable",
            "navbar_trans_about_us_en"    => "required",
            "navbar_trans_about_us_ar"    => "sometimes|nullable",
            "navbar_trans_contact_us_en"  => "required",
            "navbar_trans_contact_us_ar"  => "sometimes|nullable",

        ];

        $aboutUs = [
            "about_us_title_en"       => "required",
            "about_us_description_en" => "required",
            "about_us_title_ar"       => "sometimes|nullable",
            "about_us_description_ar" => "sometimes|nullable",
        ];

        $contactUs = [
            "contact_us_title_en"       => "required",
            "contact_us_description_en" => "required",
            "contact_us_title_ar"       => "sometimes|nullable",
            "contact_us_description_ar" => "sometimes|nullable",
            "map_address"               => "required",
        ];

        $social_links = [
            "facebook"  => "required|url",
            "instagram" => "required|url",
            "twitter"   => "required|url",
            "linkedin"  => "required|url",
            "youtube"   => "required|url",
        ];

        $services = [
            "service_title_en"         => "required",
            "service_description_en"   => "required",
            "service_title_ar"         => "sometimes|nullable",
            "service_description_ar"   => "sometimes|nullable",

            "services_en"               => "required|array",
            "services_en.*.font"        => "required",
            "services_en.*.title"       => "required",
            "services_en.*.description" => "required",

            "services_ar"               => "sometimes|nullable|array",
            "services_ar.*.font"        => "sometimes|nullable",
            "services_ar.*.title"       => "sometimes|nullable",
            "services_ar.*.description" => "sometimes|nullable",
        ];

        $branches = [
            "branch_title_en"         => "required",
            "branch_description_en"   => "required",
            "branch_title_ar"         => "sometimes|nullable",
            "branch_description_ar"   => "sometimes|nullable",

            "branches_en"               => "required|array",
            "branches_en.*.image"       => "sometimes|nullable|image",
            "branches_en.*.title"       => "required",
            "branches_en.*.description" => "required",

            "branches_ar"               => "sometimes|nullable|array",
            "branches_ar.*.image"       => "sometimes|nullable|image",
            "branches_ar.*.title"       => "sometimes|nullable",
            "branches_ar.*.description" => "sometimes|nullable",
        ];

        return [];
        return array_merge(
            $general,
            $navbar,
            $aboutUs,
            $contactUs,
            $social_links,
            $services,
            $branches,
        );
    }
}

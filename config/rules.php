<?php

$general = [
    "g_recaptcha_response"  => "required|captcha",
    "email"                 => "required|email|max:255",
    "edit_email"            => "required|email|max:255",
    "permissions"           => "required|array",
    "is_promoted"           => "required",
    "rank"                  => "required|string",
    "password"              => "required|string|min:8|confirmed",
];

$smallTexts = [
    "name"         => "required|min:3|max:9999",
    "name_en"      => "required|min:3|max:9999",
    "name_ar"      => "sometimes|nullable|min:3|max:9999",
    "username"     => "required|string",

    "edit_name"     => "required|min:3|max:9999",
    "edit_name_en"  => "required|min:3|max:9999",
    "edit_name_ar"  => "sometimes|nullable|min:3|max:9999",
];

$longTexts = [
    "description"         => "required|min:3|max:3500",
    "edit_description"    => "required|min:3|max:3500",

    "description_en"      => "required|min:3|max:3500",
    "description_ar"      => "sometimes|nullable|min:3|max:3500",

    "edit_description_en" => "sometimes|nullable|min:3|max:3500",
    "edit_description_ar" => "sometimes|nullable|nullable|min:3|max:3500",

];

$ids = [
    "role_id"        => "required|integer|exists:roles,id",
    "category_id"    => "required|integer|exists:categories,id",

];

$numbers = [
    "phone"       => "required",
    "edit_phone"  => "sometimes|nullable",
];

$files = [
    "image"          => "required|image",
    "logo_en"        => "sometimes|nullable|image",
    "logo_ar"        => "sometimes|nullable|nullable|image",
    "favicon_en"     => "sometimes|nullable|image",
    "favicon_ar"     => "sometimes|nullable|nullable|image",
    "other_images"   => "sometimes|nullable|array",
    "other_images.*" => "required|image",
    "file"           => "required|mimes:pdf",

    "edit_image"          => "sometimes|nullable|image",
    "edit_other_images"   => "sometimes|nullable|array",
    "edit_other_images.*" => "sometimes|nullable|image",
    "edit_file"           => "sometimes|nullable|mimes:pdf",
];

$links = [
    "facebook"         => "required|url",
    "instagram"        => "required|url",
    "twitter"          => "required|url",
    "linkedin"         => "required|url",
    "youtube"          => "required|url",
];

return array_merge(
    $general,
    $ids,
    $numbers,
    $smallTexts,
    $longTexts,
    $files,
    $links
);

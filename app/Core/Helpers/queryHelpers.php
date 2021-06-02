<?php

use Illuminate\Http\UploadedFile;
use App\Core\Services\MediaService;
use App\Domains\Setting\Entities\Setting;

function GetSettingMediaUrl(string $key, string $collection = "Setting-Collection")
{
    $media = Setting::where("key", $key)->first();
    if ($media) {
        if ($media->getMedia($collection)->count()) {
            $media = $media->getMedia($collection)->first()->getUrl();
            return $media;
        }
    }
    return DefaultImage();
}

function GetSettingMedia(string $key = "logo")
{
    return Setting::where("key", $key)->first();
}

function GetSettingByKey(string $val)
{
    static $keys = [];
    if (isset($keys[$val])) {
        return $keys[$val];
    }
    $result = Setting::where("key", $val)->first();
    if ($result) {
        $keys[$val] = $result->data;
        return $keys[$val];
    }
    return null;
}

function GetSettingTransByKey(string $val)
{
    static $transKeys = [];
    if (isset($transKeys[$val])) {
        return $transKeys[$val];
    }
    $result = Setting::where("key", $val."_".app()->getLocale())->first();
    if ($result) {
        $transKeys[$val] = $result->data;
        return $transKeys[$val];
    }
    return null;
}

<?php

namespace App\Domains\Setting\Http\Controllers\AdminPanel;

use DB;
use Str;
use Route;
use Artisan;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Core\Services\MediaService;
use App\Http\Controllers\Controller;
use App\Core\Services\AdminPanelService;
use App\Domains\Setting\Entities\Setting;
use App\Domains\Setting\Http\Requests\AdminPanel\AdminSettingsRequest;

class AdminSettingController extends Controller
{
    public $domainAlias = "settings";

    public $nameSpace = "adminpanel";

    public $crudName = "settings";

    public $singleMedia = [
        "logo_ar",
        "logo_en",
        "favicon_ar",
        "favicon_en",
    ];

    public $multiMedia = [
        "gallery",
        "perspective",
        "standered_demin",

    ];

    public function __construct()
    {
        $this->middleware("role_or_permission:Super_Role|Manager_Role|Edit_GeneralSetting");
    }

    public function generalSettingMedia(Request $request)
    {
        return ShowMultiImagesFromStorage(GetSettingMedia($request->key), "Multi-Setting-Collection");
    }

    public function edit()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.index")->with([
            "title"       => __("main.setting"),
            "domainAlias" => $this->domainAlias,
            "nameSpace"   => $this->nameSpace,
            "crudName"    => $this->crudName,
        ]);
    }

    public function update(AdminSettingsRequest $request)
    {
        DB::beginTransaction();
        try {
            $incoming_data = $request->all();
            foreach ($incoming_data as $main_key => $newValue) {
                if (!Str::startsWith($main_key, "_")) {
                    foreach ($this->singleMedia as $media_key) {
                        if ($main_key == $media_key) {
                            if ($incoming_data[$main_key] instanceof UploadedFile) {
                                $entitySingleMedia = Setting::firstOrCreate(["key" => $main_key]);
                                MediaService::updateImage($entitySingleMedia, $main_key);
                            }
                        }
                    }
                    foreach ($this->multiMedia as $media_key) {
                        if ($main_key == $media_key) {
                            $entityMultiMedia = Setting::firstOrCreate(["key" => $main_key]);
                            if (ShowMultiImagesFromStorage($entityMultiMedia, "Multi-Setting-Collection") != []) {
                                $data[$main_key] = "{}";
                            }
                            MediaService::updateMultiImages($entityMultiMedia, $main_key, "{$main_key}_original_name");
                        }
                    }
                    Setting::updateOrCreate(
                        ["key"  => $main_key],
                        [
                            "data" => $incoming_data[$main_key] == "null" || $incoming_data[$main_key] == "[null]" ? null : $incoming_data[$main_key],
                        ],
                    );
                }
            }
            Session::flash("success", __("main.session_updated_message"));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }
}

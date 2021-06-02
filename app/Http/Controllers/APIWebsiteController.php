<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use App\Core\Abstracts\ResourceController;

class APIWebsiteController extends ResourceController
{
    public function getSiteInformation()
    {
        return $this->apiJsonResponse([
            "message"  => __("main.site_infomations"),
            "response" => [
                "terms"      => GetSettingTransByKey("terms"),
                "conditions" => GetSettingTransByKey("conditions"),
                "about_us"   => GetSettingTransByKey("about_us"),
            ],
        ], 200);
    }

    /**
     * Upload a file
     * Package laravel-directory-cleanup takes care of removing old, unused uploads - see the file of that name in the config dir
     * @return \Illuminate\Http\Response
     */
    public function mediaStore(Request $request)
    {
        $request->validate([
            "file" => "required|file",
        ]);
        $file = $request->file("file");
        $path = $file->store("uploads");
        return response()->json([
            "name"          => $path,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Show an uploaded file
     * @return \Illuminate\Http\Response
     */
    public function mediaShow(Media $mediaItem, string $size = null)
    {
        try {
            return \Response::download($mediaItem->getPath(), $mediaItem->name, [
                "Content-Length: ". filesize($mediaItem->getPath())
            ]);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }

}

<?php

namespace App\Core\Services;

use DB;
use Log;
use Str;
use File;
use Exception;
use Illuminate\Http\UploadedFile;

class MediaService
{
    /**
     * the file dynamic function
     * @param string $dir           'file directory'
     * @param $file
     * @param $checkFunction
     * @return string
     */
    public static function UploadFile($dir, $file, $oldFile = null) : string
    {
        try {
            DB::beginTransaction();
            $saveFile = '';
            if (!File::exists(public_path('uploads').'/' . $dir)) {
                File::makeDirectory(public_path('uploads') . '/' . $dir, 0775, true);
            }
            if (File::isFile($file)) {
                if ($oldFile) {
                    self::DeleteFile($oldFile);
                }
                ini_set('memory_limit', '-1');
                $name       = $file->getClientOriginalName();
                $extension  = $file->getClientOriginalExtension();
                $sha1       = sha1($name);
                $dirPerfix  = rand(1, 1000000) . "_" . date("y-m-d-h-i-s") . "_" . $sha1;
                $file->move(public_path("uploads/{$dir}/{$dirPerfix}"), $name);
                $saveFile = "/uploads/{$dir}/{$dirPerfix}/{$name}";
            }
            return $saveFile;
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * This Function for Delete File from uploads Dir
     * @param $file
     * @return bool
     */
    public static function DeleteFile($file) : bool
    {
        if (isset($file)) {
            if (File::exists($_SERVER['DOCUMENT_ROOT'].$file)) {
                return File::delete($_SERVER['DOCUMENT_ROOT'].$file);
            }
        }
        return false;
    }

    /**
     * Store Image
     * @param  string $_entity
     * @param  string $_requestName
     * @param  string $_collectionPrefix
     * @return void
     */
    public static function storeImage(object $_entity, string $_requestName, string $_collectionPrefix = "") : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity) && request()->has($_requestName)) {
                $mediaCollectionName = ($_collectionPrefix ? "{$_collectionPrefix}-" : "") . $_entity->getEntityClassName(). "-Collection";
                $_entity->addMediaFromRequest($_requestName)->usingName($_requestName)->toMediaCollection($mediaCollectionName);
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Update Image
     * @param  string $_entity
     * @param  string $_requestName
     * @param  string $_clearOldMedia
     * @param  string $_collectionPrefix
     * @return void
     */
    public static function updateImage(object $_entity, string $_requestName, bool $_clearOldMedia = true, string $_collectionPrefix = "") : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity) && request()->has($_requestName)) {
                $mediaCollectionName = ($_collectionPrefix ? "{$_collectionPrefix}-" : "") . $_entity->getEntityClassName(). "-Collection";
                if ($_clearOldMedia) {
                    $_entity->clearMediaCollection($mediaCollectionName);
                }
                $_entity->addMediaFromRequest($_requestName)->usingName($_requestName)->toMediaCollection($mediaCollectionName);
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Store Multi Images
     * @param  string $_entity
     * @param  string $_requestName
     * @param  string $_requestFilesName
     * @return void
     */
    public static function storeMultiImages(object $_entity, string $_requestName, string $_requestFilesName) : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity) && is_array(request($_requestName)) && is_array(request($_requestFilesName))) {
                foreach (request($_requestName) as $index => $file) {
                    $_entity->addMedia(storage_path("app/{$file}"))->usingName(request($_requestFilesName)[$index])->toMediaCollection("Multi-". $_entity->getEntityClassName() . "-Collection");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * edit multi Images
     * @param  string $_entity
     * @param  string $_requestName
     * @param  string $_requestFilesName
     * @return void
     */
    public static function updateMultiImages(object $_entity, string $_requestName, string $_requestFilesName) : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity)) {
                $_entity->load("media");
                $mediaCollectionName = "Multi-". $_entity->getEntityClassName() . "-Collection";
                $multiCollection = $_entity->getMedia($mediaCollectionName);
                if (count($multiCollection)) {
                    foreach ($multiCollection as $media) {
                        if (!in_array($media->file_name, request($_requestName))) {
                            $media->delete();
                        }
                    }
                }
                $file_names = $_entity->media->pluck("file_name")->toArray();
                foreach (request($_requestName) as $index => $file) {
                    if (count($file_names) === 0 || !in_array($file, $file_names)) {
                        $_entity->addMedia(storage_path("app/{$file}"))->usingName(request($_requestFilesName)[$index])->toMediaCollection($mediaCollectionName);
                    }
                    $data = $multiCollection->where('file_name', $file)->first();
                    if ($data) {
                        $data->order_column = $index;
                        $data->save();
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * store multi Images api
     * @param  string $_entity
     * @param  string $_requestName
     * @return void
     */
    public static function storeMultiImagesAPI(object $_entity, string $_requestName, string $_requestFilesName) : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity) && is_array(request($_requestName)) && is_array(request($_requestFilesName))) {
                foreach (request($_requestName) as $index => $file) {
                    $_entity->addMedia(storage_path("app/{$file}"))->usingName(request($_requestFilesName)[$index])->toMediaCollection("Multi-". $_entity->getEntityClassName() . "-Collection");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * update multi Images api
     * @param  string $_entity
     * @param  string $_requestName
     * @return void
     */
    public static function updateMultiImagesAPI(object $_entity, string $_requestName, string $_requestFilesName) : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity) && is_array(request($_requestName)) && is_array(request($_requestFilesName))) {
                foreach (request($_requestName) as $index => $file) {
                    $_entity->addMedia(storage_path("app/{$file}"))->usingName(request($_requestFilesName)[$index])->toMediaCollection("Multi-". $_entity->getEntityClassName() . "-Collection");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * delete all media of current entity
     * @param  string $_entity
     * @return void
     */
    public static function deleteImage(object $_entity) : void
    {
        try {
            DB::beginTransaction();
            if (is_object($_entity)) {
                $_entity->clearMediaCollection();
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }
}

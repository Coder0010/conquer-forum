<?php

namespace App\Domains\Setting\Entities;

use File;
use App\Core\Abstracts\Entity;
use App\Core\Services\MediaService;

class Setting extends Entity
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'key',
        'data',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::saved(function ($entity) {
            $entity->setMultiImageForEntity("branches_en");
            $entity->setMultiImageForEntity("branches_ar");
        });
    }

    /**
     * setMultiImageForEntity
     */
    public function setMultiImageForEntity(string $_request)
    {
        if ($this->key == $_request) {
            $data = request($_request);
            if ($data &&  is_array($data)) {
                foreach ($data as $key => $value) {
                    if (isset($data[$key]) && isset($data[$key]['image']) && File::exists($data[$key]['image'])) {
                        $_collectionPrefix = "{$_request}-{$key}";
                        $mediaCollectionName = ($_collectionPrefix ? "{$_collectionPrefix}-" : "") . "Collection";
                        $this->clearMediaCollection($mediaCollectionName);
                        $this->addMediaFromRequest("{$_request}[{$key}]['image']")->usingName("{$_request}[{$key}]['image']")->toMediaCollection($mediaCollectionName);
                    }
                }
            }
        }
    }
}

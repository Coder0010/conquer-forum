<?php

namespace App\Core\Traits;

use File;

trait ModelHelper
{
    /**
     * Get Entity Name
     */
    public function getEntityClassName() : String
    {
        $entityNamespace = array_slice(explode("\\", get_class($this)), -1, 1, true);
        $entityName = array_values($entityNamespace)[0];
        return $entityName;
    }

    /**
     * registerMediaCollections
     */
    public function registesrMediaCollections()
    {
        $className = $this->getEntityClassName();
        $this->addMediaCollection("{$className}-Collection")->singleFile();
        $this->addMediaCollection("Another-{$className}-Collection")->singleFile();
        $this->addMediaCollection("Multi-{$className}-Collection");
    }

    /**
     * getMainMedia
     */
    public function getMainMedia(string $_collectionPrefix = "")
    {
        $mediaCollectionName = ($_collectionPrefix ? "{$_collectionPrefix}-" : "") . $this->getEntityClassName(). "-Collection";
        if (!empty($this->getMedia($mediaCollectionName)->first())) {
            return $this->getMedia($mediaCollectionName)->first()->getUrl();
        }
        return DefaultImage();
    }

    /**
     * getOtherMedia
     */
    public function getOtherMedia()
    {
        $className = $this->getEntityClassName();
        if (count($this->getMedia("Multi-{$className}-Collection"))) {
            return $this->getMedia("Multi-{$className}-Collection");
        }
        return [DefaultImage()];
    }
}

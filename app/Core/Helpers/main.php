<?php
/**
 * Remove any Special Char at string
 * @return string $string
 */
function CalculatePercentage($oldFigure, $newFigure)
{
    if (($oldFigure != 0) && ($newFigure != 0)) {
        $percentChange = number_format((1 - $oldFigure / $newFigure) * 100, 2) .'%';
    } else {
        $percentChange = null;
    }
    return $percentChange;
}

/**
 * Remove any Special Char at string
 * @return string $string
 */
function ClearString(string $string, $char = '-'): string
{
    return preg_replace('/[^A-Za-z0-9]/', $char, $string);
}

/**
 * Prettify string
 * @return string $string
 */
function PrettifyString(string $word): string
{
    return Str::title(Str::kebab(Str::camel($word)));
}

/**
 * Return DefaultImage
 * @param string $source
 */
function DefaultImage($source = 'adminpanel/assets/media/logos/favicon.ico')
{
    return asset($source);
}

/**
 * Return Image With Path From Storage Using Media Library Spaite
 * @param $_entity
 * @param string $_collection
 */
function GetImageUrlFromStorage($_entity, string $_collection)
{
    if (!is_null($_entity) && !is_null($_collection)) {
        if (!empty($_entity->getMedia($_collection)[0])) {
            return $_entity->getMedia($_collection)[0]->getUrl();
        }
    }
    return DefaultImage();
}

/**
 * Return Images With Path From Storage Using Media Library Spaite
 * @param string $_entity
 * @param string $_collection
 */
function ShowMultiImagesFromStorage($_entity, string $_collection)
{
    if (!is_null($_entity) && !is_null($_collection)) {
        if (count($_entity->getMedia($_collection)) > 0 && !empty($_entity->getMedia($_collection)[0])) {
            return $_entity->getMedia($_collection);
        }
    }
    return [];
}

/**
 * Return Images With Path From Storage Using Media Library Spaite
 * @param string $_entity
 * @param string $_collection
 */
function GetMultiImagesUrlFromStorage($_entity, string $_collection)
{
    if (count($multi_collection = $_entity->getMedia($_collection))) {
        foreach ($multi_collection as $key) {
            $other_media[] = $key->getUrl();
        }
        return $other_media;
    }
    return [];
}

/**
 * Return true or false
 * @param string $permissions
 * @param string $roles
 */
function CheckPermissionOrRole($permissions = null, $roles = null)
{
    if ($permissions && $roles) {
        if (auth()->user()->hasAnyRole([$roles]) || auth()->user()->hasAnyPermission(explode('||', $permissions))) {
            return true;
        }
    }
    if ($permissions) {
        if (auth()->user()->hasAnyPermission(explode('||', $permissions))) {
            return true;
        }
    }
    if ($roles) {
        if (auth()->user()->hasAnyRole([$roles])) {
            return true;
        }
    }
    return false;
}

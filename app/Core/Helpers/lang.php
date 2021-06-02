<?php

/**
 * Get The Application Languages.
 *
 * @return array
 */
function AppLanguages() : array
{
    // return ['ar'];
    switch (GetLanguage()) {
        case 'en':
            return ['en', 'ar'];
            break;
        default:
            return ['ar', 'en'];
            break;
    }
}

/**
 * Get The Application Locale.
 *
 * @return string
 */
function GetLanguage() : string
{
    return app()->getLocale();
}

/**
 * Get's The Site Direction.
 * @return string
 */
function GetDirection() : string
{
    return GetLanguage() == 'ar' ? 'rtl' : 'ltr';
}

/**
 * Get's The Default Language.
 * @return string
 */
function GetDefaultLang() : string
{
    return 'en';
}

/**
 * if design isRtl.
 * @return bool
 */
function isRtl() : bool
{
    return GetLanguage() == 'ar' ? true : false;
}

/**
 * @param $language
 * @param $key
 * @return string
 */
function GetLanguageValues($language, $key) : string
{
    return config("languages.languages.{$language}")[$key];
}

/**
 * Add rtl
 * @return string
 */
function addRtl() : string
{
    return GetDirection() == 'rtl' ? '.rtl' : '';
}

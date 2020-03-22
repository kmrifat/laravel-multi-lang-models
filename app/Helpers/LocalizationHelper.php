<?php


namespace App\Helpers;


use Illuminate\Support\Facades\File;

class LocalizationHelper
{
    public function getAllLanguages()
    {
        $langs = array_map('basename', File::directories(resource_path('lang')));
        return $langs;
    }
}

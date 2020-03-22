<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function getLang()
    {
        $blogTranslate = $this->hasOne(BlogTranslation::class)->where('lang', config('app.locale'));
        if (!$blogTranslate->exists()) {
            $blogTranslate = $this->hasOne(BlogTranslation::class)->where('lang', config('app.fallback_locale'));
        }

        return $blogTranslate;
    }

    public function getLangByUrl()
    {
        $blogTranslate = $this->hasOne(BlogTranslation::class)->where('lang', request()->query('lang'));
        if (!$blogTranslate->exists()) {
            $blogTranslate = $this->hasOne(BlogTranslation::class)->where('lang', config('app.fallback_locale'));
        }
        return $blogTranslate;
    }
}

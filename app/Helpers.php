<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

function settings($key){
    $settings = Cache::rememberForever('settings', function () {
        return Settings::first() ?? NullSetting::make();
    });
   return $settings->{$key};
}
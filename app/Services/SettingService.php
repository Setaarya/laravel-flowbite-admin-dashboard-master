<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getSettings()
    {
        return Setting::first() ?? new Setting(); 
    }

    public function updateSettings(array $data)
    {
        $settings = Setting::firstOrCreate([]);
        $settings->update($data);
        return $settings;
    }
}
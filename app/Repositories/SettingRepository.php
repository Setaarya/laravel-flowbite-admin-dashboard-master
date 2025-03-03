<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function getSettings()
    {
        return Setting::first();
    }

    public function updateSettings(array $data)
    {
        $settings = Setting::firstOrCreate([]);
        $settings->update($data);
        return $settings;
    }
}
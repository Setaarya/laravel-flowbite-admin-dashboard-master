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

        // Cek apakah ada gambar yang diupload
        if (isset($data['app_logo']) && $data['app_logo'] instanceof \Illuminate\Http\UploadedFile) {
            // Simpan file ke storage/app/public/logo
            $path = $data['app_logo']->store('logo', 'public');
            $data['app_logo'] = $path; // Simpan path ke database
        }

        $settings->update($data);

        return $settings;
    }
}
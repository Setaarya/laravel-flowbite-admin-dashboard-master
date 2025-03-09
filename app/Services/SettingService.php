<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getSettings()
    {
        return $this->settingRepository->getSettings();
    }

    public function updateSettings(array $data)
    {
        // Cek apakah ada gambar yang diupload
        if (isset($data['app_logo']) && $data['app_logo'] instanceof \Illuminate\Http\UploadedFile) {
            // Simpan file ke storage/app/public/logo
            $path = $data['app_logo']->store('logo', 'public');
            $data['app_logo'] = $path; // Simpan path ke database
        }

        return $this->settingRepository->updateSettings($data);
    }
}



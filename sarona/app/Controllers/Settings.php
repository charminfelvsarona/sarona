<?php

namespace App\Controllers;

use App\Models\SystemSettingModel;
use CodeIgniter\Controller;

class Settings extends Controller
{
    // Toggle system mode (admin only)
    public function toggleSystemMode()
    {
        $settingModel = new SystemSettingModel();
        $setting = $settingModel->first();

        if (!$setting) {
            $settingModel->insert(['system_mode' => 'online']);
            $setting = $settingModel->first();
        }

        $newMode = ($setting['system_mode'] === 'online') ? 'maintenance' : 'online';
        $settingModel->update($setting['id'], ['system_mode' => $newMode]);

        session()->setFlashdata('success', 'System switched to ' . ucfirst($newMode) . ' Mode.');
        return redirect()->to(site_url('employees'));
    }

    // Used by employee pages to check mode
    public function checkSystemMode()
    {
        $settingModel = new SystemSettingModel();
        $setting = $settingModel->first();
        return $setting['system_mode'] ?? 'online';
    }
}

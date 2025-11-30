<?php namespace App\Controllers;

use App\Models\SystemSettingModel;
use CodeIgniter\Controller;

class SettingsController extends Controller
{
    public function toggleSystemMode()
    {
        $model = new SystemSettingModel();

        // Always get the first (and only) record
        $setting = $model->first();

        // If no record exists, create one with default mode
        if (!$setting) {
            $model->insert(['system_mode' => 'online']);
            $setting = $model->first();
        }

        // Toggle mode
        $newMode = ($setting['system_mode'] === 'online') ? 'maintenance' : 'online';
        $model->update($setting['id'], ['system_mode' => $newMode]);

        session()->setFlashdata('success', "System mode switched to <b>$newMode</b>.");
        return redirect()->back();
    }
}

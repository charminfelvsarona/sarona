<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SystemSettingModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $model = new SystemSettingModel();
        $setting = $model->first();

        if ($setting && $setting['system_mode'] === 'maintenance') {

            $uri = service('uri')->getPath();

            // ✅ Allowed routes during maintenance (admin area)
            $allowedPaths = [
                'login', 'logout', 'register',
                'settings', 'employees', 'departments', 'reports', 'maintenance'
            ];

            foreach ($allowedPaths as $allowed) {
                if (strpos($uri, $allowed) !== false) {
                    return; // allow access
                }
            }

            // 🚫 Block employee routes only
            if (strpos($uri, 'employee') !== false) {
                return redirect()->to('/maintenance');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing needed
    }
}

<?php

use App\Models\ActivityLogModel;

if (!function_exists('log_activity')) {
    function log_activity($action)
    {
        $logModel = new ActivityLogModel();

        // Get client IP and MAC
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $mac = 'UNKNOWN';

        // Detect localhost
        if (in_array($ip, ['::1', '127.0.0.1'])) {
            $ip = 'LOCALHOST';
            $mac = 'LOCALHOST';
        } else {
            // Try to get MAC from ARP table
            $output = [];
            if (PHP_OS_FAMILY === 'Windows') {
                @exec("arp -a " . escapeshellarg($ip), $output);
            } else {
                @exec("arp -n " . escapeshellarg($ip), $output);
            }

            if (!empty($output)) {
                foreach ($output as $line) {
                    if (preg_match('/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/', $line, $matches)) {
                        $mac = strtoupper($matches[0]);
                        break;
                    }
                }
            }
        }

        // Get session (for both Admin and Employee)
        $session = session();
        $userId = $session->get('user_id') 
                ?? $session->get('employee_id') 
                ?? null;

        // Insert into DB
        $logModel->insert([
            'user_id'     => $userId,
            'action'      => $action,
            'ip_address'  => $ip,
            'mac_address' => $mac,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}

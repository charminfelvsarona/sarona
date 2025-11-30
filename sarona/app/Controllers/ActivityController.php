<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use App\Models\UserModel;
use App\Models\EmployeeModel;

class ActivityController extends BaseController
{
    public function index()
    {
        $activityModel = new ActivityLogModel();
        $logs = $activityModel->orderBy('created_at', 'DESC')->findAll();

        // Optional: enrich user/employee name
        $userModel = new UserModel();
        $employeeModel = new EmployeeModel();

        foreach ($logs as &$log) {
            $log['username'] = 'System';
            if (!empty($log['user_id'])) {
                $user = $userModel->find($log['user_id']);
                if ($user) {
                    $log['username'] = $user['username'];
                } else {
                    $employee = $employeeModel->find($log['user_id']);
                    if ($employee) {
                        $log['username'] = $employee['fullname'];
                    }
                }
            } else {
                if (preg_match('/Employee logged in: (.+)$/', $log['action'], $matches)) {
                    $log['username'] = $matches[1];
                }
            }
        }

        // Load your view at views/activity_logs.php
        return view('activity_logs', ['logs' => $logs]);
    }
}

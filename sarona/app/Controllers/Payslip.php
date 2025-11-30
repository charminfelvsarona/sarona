<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Payslip extends BaseController
{
    public function generate()
    {
        helper('activity'); // Make sure the log_activity helper is loaded

        $request = $this->request->getJSON(true); // Accept JSON from fetch
        $fullname = $request['fullname'] ?? '';
        $position = $request['position'] ?? '';

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel
            ->where('fullname', $fullname)
            ->where('position', $position)
            ->first();

        if ($employee) {
            // ✅ Log activity on the server
            log_activity("Generated payslip for employee: " . $employee['fullname']);

            return $this->response->setJSON([
                'status' => 'success',
                'employee' => $employee
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Employee not found.'
            ]);
        }
    }
}

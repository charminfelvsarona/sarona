<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;
use App\Models\EmployeeModel;

class EmployeeController extends Controller
{
    // Show employee login form
    public function login()
    {
        return view('employee/login');
    }

    // Handle login form submission
    public function loginPost()
    {
        $fullname = $this->request->getPost('fullname');
        $position = $this->request->getPost('position');

        $db = Database::connect();
        $employee = $db->table('employees')
            ->where('fullname', $fullname)
            ->where('position', $position)
            ->get()
            ->getRowArray();

        if ($employee) {
            // ✅ Save session data
            session()->set('employee_id', $employee['id']);
            session()->set('employee_name', $employee['fullname']);

            // ✅ Log activity with IP & MAC
            log_activity("Employee logged in: " . $employee['fullname']);

            return redirect()->to('/employee/dashboard')
                             ->with('success', 'Welcome back, ' . $employee['fullname']);
        } else {
            return redirect()->back()->with('error', 'Invalid name or position.');
        }
    }

    // Dashboard
    public function dashboard()
    {
        if (!session()->get('employee_id')) {
            return redirect()->to('employee/login');
        }

        return view('employee/dashboard', [
            'employee_name' => session()->get('employee_name')
        ]);
    }

    // Create new employee (admin)
    public function create()
    {
        $employeeModel = new EmployeeModel();
        $data = [
            'fullname'   => $this->request->getPost('fullname'),
            'position'   => $this->request->getPost('position'),
            'department' => $this->request->getPost('department'),
            'salary'     => $this->request->getPost('salary'),
        ];

        $employeeModel->insert($data);

        // ✅ Log employee creation
        log_activity("Added new employee: " . $data['fullname']);

        return redirect()->to('employees')->with('message', 'Employee added successfully');
    }

    // Logout
    public function logout()
    {
        log_activity("Employee logged out: " . session()->get('employee_name'));
        session()->destroy();
        return redirect()->to('employee/login');
    }
}

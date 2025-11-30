<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\SystemSettingModel;

class Employees extends BaseController
{
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $settingModel = new SystemSettingModel();

        $setting = $settingModel->first();
        if (!$setting) {
            $settingModel->insert(['system_mode' => 'online']);
            $setting = $settingModel->first();
        }

        $data['system_mode'] = $setting['system_mode'];
        $data['employees'] = $employeeModel->getAllWithDepartment();

        $data['message'] = session()->getFlashdata('message');
        $data['alertType'] = session()->getFlashdata('alertType');

        return view('employees/index', $data);
    }

    public function create()
    {
        $departmentModel = new DepartmentModel();
        $data['departments'] = $departmentModel->findAll();
        return view('employees/create', $data);
    }

    public function store()
    {
        $model = new EmployeeModel();
        $fullname = $this->request->getPost('fullname');

        $model->save([
            'fullname' => $fullname,
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'department_id' => $this->request->getPost('department_id'),
        ]);

        // ✅ Log activity
        log_activity("Added new employee: " . $fullname);

        session()->setFlashdata('message', 'Employee added successfully!');
        session()->setFlashdata('alertType', 'success');

        return redirect()->to('/employees');
    }

    public function edit($id)
    {
        $employeeModel = new EmployeeModel();
        $departmentModel = new DepartmentModel();

        $data['employee'] = $employeeModel->find($id);
        $data['departments'] = $departmentModel->findAll();

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $model = new EmployeeModel();
        $fullname = $this->request->getPost('fullname');

        $model->update($id, [
            'fullname' => $fullname,
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'department_id' => $this->request->getPost('department_id'),
        ]);

        // ✅ Log activity
        log_activity("Updated employee (ID: $id): " . $fullname);

        session()->setFlashdata('message', 'Employee updated successfully!');
        session()->setFlashdata('alertType', 'info');

        return redirect()->to('/employees');
    }

    public function delete($id)
    {
        $model = new EmployeeModel();
        $employee = $model->find($id);
        if ($employee) {
            $model->delete($id);

            // ✅ Log activity
            log_activity("Deleted employee (ID: $id): " . $employee['fullname']);
        }

        session()->setFlashdata('message', 'Employee deleted successfully!');
        session()->setFlashdata('alertType', 'danger');

        return redirect()->to('/employees');
    }

    public function print()
{
    helper('activity'); // Ensure the helper is loaded

    $employeeModel = new EmployeeModel();
    $db = \Config\Database::connect();

    $query = $db->table('employees')
                ->select('employees.id, employees.fullname, employees.position, employees.salary, departments.name AS department')
                ->join('departments', 'departments.id = employees.department_id', 'left')
                ->get();

    $data['employees'] = $query->getResultArray();

    // ✅ Log before returning the view
    log_activity("Printed employee list report");

    return view('employees/print', $data);
}


    public function dashboard()
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();

        $data = [
            'employees' => $employees
        ];

        // ✅ Log activity for employee dashboard access
        log_activity("Accessed employee dashboard");

        return view('employee/dashboard', $data);
    }
}

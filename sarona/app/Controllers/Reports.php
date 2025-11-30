<?php

namespace App\Controllers;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;

class Reports extends BaseController
{
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $departmentModel = new DepartmentModel();

        // Count employees per department
        $data['report'] = $employeeModel
            ->select('departments.name as department, COUNT(employees.id) as total_employees, SUM(salary) as total_salary')
            ->join('departments', 'departments.id = employees.department_id', 'left')
            ->groupBy('departments.name')
            ->findAll();

        return view('reports/index', $data);
    }
}

<?php

namespace App\Models;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fullname', 'position', 'salary', 'department_id'];

    protected $useTimestamps = true;

    // Optional: join departments for easier queries
    public function getAllWithDepartment()
    {
        return $this->select('employees.*, departments.name as department_name')
                    ->join('departments', 'departments.id = employees.department_id', 'left')
                    ->findAll();
    }
}

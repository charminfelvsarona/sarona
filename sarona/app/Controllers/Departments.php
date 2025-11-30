<?php

namespace App\Controllers;
use App\Models\DepartmentModel;

class Departments extends BaseController
{
    public function index()
    {
        $model = new DepartmentModel();
        $data['departments'] = $model->findAll();
        return view('departments/index', $data);
    }

    public function create()
    {
        return view('departments/create');
    }

    public function store()
    {
        $model = new DepartmentModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('/departments')->with('message', 'Department added successfully!')->with('alertType', 'success');
    }

    public function edit($id)
    {
        $model = new DepartmentModel();
        $data['department'] = $model->find($id);
        return view('departments/edit', $data);
    }

    public function update($id)
    {
        $model = new DepartmentModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('/departments')->with('message', 'Department updated successfully!')->with('alertType', 'info');
    }

    public function delete($id)
    {
        $model = new DepartmentModel();
        $model->delete($id);
        return redirect()->to('/departments')->with('message', 'Department deleted successfully!')->with('alertType', 'danger');
    }
}

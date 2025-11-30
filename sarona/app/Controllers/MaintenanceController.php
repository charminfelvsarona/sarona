<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance');
    }
}

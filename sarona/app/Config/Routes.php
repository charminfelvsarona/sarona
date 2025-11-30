<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================================
// 🔹 Default Route
// =======================================
$routes->get('/', 'Auth::login'); 
// You can later check session to redirect to dashboard if logged in

// =======================================
// 🔹 Authentication (Admin) Routes
// =======================================
$routes->get('login', 'Auth::login');
$routes->post('loginPost', 'Auth::loginPost');
$routes->get('register', 'Auth::register');
$routes->post('registerPost', 'Auth::registerPost');
$routes->get('logout', 'Auth::logout');

// =======================================
// 🔹 Employee Portal Routes
// =======================================
$routes->get('maintenance', 'MaintenanceController::index');
$routes->get('settings/toggleSystemMode', 'SettingsController::toggleSystemMode');
$routes->group('employee', function ($routes) {
    $routes->get('login', 'EmployeeController::login');
    $routes->post('loginPost', 'EmployeeController::loginPost');
    //$routes->get('dashboard', 'EmployeeController::dashboard');
    $routes->get('logout', 'EmployeeController::logout');
});

// =======================================
// 🔹 Employee Management (Admin)
// =======================================
$routes->group('employees', function ($routes) {
    $routes->get('/', 'Employees::index');
    $routes->get('create', 'Employees::create');
    $routes->post('store', 'Employees::store');
    $routes->get('edit/(:num)', 'Employees::edit/$1');
    $routes->post('update/(:num)', 'Employees::update/$1');
    $routes->get('delete/(:num)', 'Employees::delete/$1');
    $routes->get('print', 'Employees::print');
    

});
// ✅ Add this line OUTSIDE the group
$routes->get('activity', 'ActivityController::index');
// =======================================
// 🔹 Department Management (Admin)
// =======================================
$routes->group('departments', function ($routes) {
    $routes->get('/', 'Departments::index');
    $routes->get('create', 'Departments::create');
    $routes->post('store', 'Departments::store');
    $routes->get('edit/(:num)', 'Departments::edit/$1');
    $routes->post('update/(:num)', 'Departments::update/$1');
    $routes->get('delete/(:num)', 'Departments::delete/$1');
});

// =======================================
// 🔹 Reports
// =======================================
$routes->get('reports', 'Reports::index');

// =======================================
// 🔹 Employee Dashboard (Payslip Generator)
// =======================================
$routes->get('employee/dashboard', 'Employees::dashboard');
// Payslip generation route
$routes->post('payslip/generate', 'Payslip::generate');


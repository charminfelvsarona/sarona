<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Employee Management System') ?></title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f9f9f9;
      font-family: "Segoe UI", sans-serif;
    }
    .sidebar {
      width: 220px;
      position: fixed;
      height: 100%;
      background-color: #0d6efd;
      color: white;
      padding: 20px;
    }
    .sidebar a {
      color: white;
      display: block;
      padding: 10px 0;
      text-decoration: none;
    }
    .sidebar a.active {
      background-color: rgba(255,255,255,0.2);
      border-radius: 5px;
    }
    .content {
      margin-left: 240px;
      padding: 20px;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4><i class="bi bi-person-badge"></i> Admin Panel</h4>
  <a href="<?= site_url('employees') ?>" class="<?= service('uri')->getSegment(1) == 'employees' ? 'active' : '' ?>">
    <i class="bi bi-people-fill me-2"></i> Employees
  </a>
  <a href="<?= site_url('departments') ?>" class="<?= service('uri')->getSegment(1) == 'departments' ? 'active' : '' ?>">
    <i class="bi bi-briefcase-fill me-2"></i> Departments
  </a>
  <a href="<?= site_url('reports') ?>"><i class="bi bi-bar-chart-line-fill me-2"></i> Reports</a>
  <a href="#"><i class="bi bi-gear-fill me-2"></i> Settings</a>
  <a href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="content">

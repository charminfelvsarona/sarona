  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      body { min-height: 100vh; display: flex; background-color: #f8f9fa; font-family: "Poppins", sans-serif; }
      .sidebar { width: 250px; background-color: #0d6efd; color: #fff; flex-shrink: 0; display: flex; flex-direction: column; padding: 20px 0; position: fixed; height: 100%; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
      .sidebar h4 { text-align: center; font-weight: 700; margin-bottom: 1rem; }
      .sidebar a { color: #dce3f3; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; font-size: 15px; }
      .sidebar a:hover, .sidebar a.active { background-color: #0b5ed7; color: #fff; }
      .content { flex-grow: 1; margin-left: 250px; padding: 40px; }
      #liveToast { animation: slideDown 0.5s ease forwards; opacity: 0; }
      @keyframes slideDown { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    </style>
  </head>

  <body>
    <div class="sidebar">
  <h4><i class="bi bi-person-badge"></i> Admin Panel</h4>
  <a href="<?= site_url('employees') ?>" class="<?= service('uri')->getSegment(1) == 'employees' ? 'active' : '' ?>"><i class="bi bi-people-fill me-2"></i> Employees</a>
  <a href="<?= site_url('departments') ?>" class="<?= service('uri')->getSegment(1) == 'departments' ? 'active' : '' ?>"><i class="bi bi-briefcase-fill me-2"></i> Departments</a>
  <a href="<?= site_url('reports') ?>" class="<?= service('uri')->getSegment(1) == 'reports' ? 'active' : '' ?>"><i class="bi bi-bar-chart-line-fill me-2"></i> Reports</a>
  <a href="<?= site_url('activity') ?>" class="<?= service('uri')->getSegment(1) == 'activity' ? 'active' : '' ?>"><i class="bi bi-clock-history me-2"></i> Activity Logs</a>

  <div class="mt-4 text-center">
    <p class="mb-1 fw-bold">
      System Mode: 
      <span class="badge <?= ($system_mode === 'maintenance') ? 'bg-danger' : 'bg-success' ?>">
        <?= ucfirst($system_mode) ?>
      </span>
    </p>
    <a href="<?= site_url('settings/toggleSystemMode') ?>" class="btn btn-outline-light mt-2">
      <i class="bi bi-power"></i>
      <?= ($system_mode === 'maintenance') ? 'Switch to Online' : 'Switch to Maintenance' ?>
    </a>
  </div>

  <a href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
</div>

    <!-- Main Content -->
    <div class="content container-fluid">
      <?php if (!empty($message)): ?>
      <div id="liveToast" class="toast text-bg-<?= esc($alertType) ?> position-fixed top-0 start-50 translate-middle-x mt-4 show shadow" style="z-index:2000; min-width:340px;">
        <div class="d-flex">
          <div class="toast-body text-center w-100">
            <i class="bi <?= $alertType == 'success' ? 'bi-check-circle-fill' : ($alertType == 'danger' ? 'bi-x-circle-fill' : 'bi-info-circle-fill') ?> me-2"></i>
            <strong><?= esc($message) ?></strong>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      </div>
      <?php endif; ?>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">Employee List</h2>
        <div>
          <a href="<?= site_url('employees/create') ?>" class="btn btn-primary me-2"><i class="bi bi-plus-circle"></i> Add Employee</a>
          <a href="<?= site_url('employees/print') ?>" target="_blank" class="btn btn-success"><i class="bi bi-printer"></i> Print</a>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Salary</th>
                <th width="160">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($employees)): ?>
              <?php foreach ($employees as $row): ?>
              <tr>
                <td class="text-center"><?= $row['id'] ?></td>
                <td><?= esc($row['fullname']) ?></td>
                <td><?= esc($row['position']) ?></td>
                <td><?= esc($row['department_name'] ?? 'Unassigned') ?></td>
                <td>₱<?= number_format($row['salary'], 2) ?></td>
                <td class="text-center">
                  <a href="<?= site_url('employees/edit/'.$row['id']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                  <a href="<?= site_url('employees/delete/'.$row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="bi bi-trash"></i> Delete</a>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php else: ?>
              <tr><td colspan="6" class="text-center text-muted py-3">No employees found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const toastEl = document.getElementById('liveToast');
      if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
      }
    </script>
  </body>
  </html>

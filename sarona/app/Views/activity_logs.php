<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; font-family: "Poppins", sans-serif; }
    .table thead { background-color: #0d6efd; color: white; }
    .card { border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
    .page-header { display: flex; justify-content: space-between; align-items: center; }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="page-header mb-4">
      <h2 class="fw-bold text-primary"><i class="bi bi-clock-history"></i> Activity Logs</h2>
      <a href="<?= site_url('employees') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
      </a>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-hover align-middle">
          <thead>
            <tr class="text-center">
              <th>ID</th>
              <th>User</th>
              <th>Action</th>
              <th>IP Address</th>
              <th>MAC Address</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($logs)): ?>
              <?php foreach ($logs as $log): ?>
                <tr>
                  <td class="text-center"><?= $log['id'] ?></td>
                  <td class="text-center"><?= esc($log['username'] ?? 'N/A') ?></td>
                  <td><?= esc($log['action']) ?></td>
                  <td class="text-center"><?= esc($log['ip_address']) ?></td>
                  <td class="text-center"><?= esc($log['mac_address']) ?></td>
                  <td class="text-center text-muted">
                    <i class="bi bi-clock"></i> <?= date('Y-m-d h:i A', strtotime($log['created_at'])) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="6" class="text-center text-muted py-4">No activity logs found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

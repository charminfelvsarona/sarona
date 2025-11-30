<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="card shadow p-4 border-0 rounded-4" style="width:400px;">
  <h3 class="text-center mb-4 text-primary">Employee Login</h3>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="<?= base_url('employee/loginPost') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Position</label>
      <input type="text" name="position" class="form-control" placeholder="Enter your position" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>

  <div class="text-center mt-3">
    <a href="<?= base_url('/') ?>" class="text-decoration-none small text-muted">← Back to Admin Login</a>
  </div>
</div>
</body>
</html>

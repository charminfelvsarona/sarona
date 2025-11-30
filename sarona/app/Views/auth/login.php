<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Employee System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card shadow p-4 border-0 rounded-4" style="width:400px;">
  <h3 class="text-center mb-4 text-primary"><i class="bi bi-person-circle"></i> Admin Login</h3>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="<?= base_url('loginPost') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label class="form-label fw-semibold">Username</label>
      <input type="text" name="username" class="form-control" placeholder="Enter username" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter password" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">
      <i class="bi bi-box-arrow-in-right"></i> Login as Admin
    </button>
  </form>

  <div class="text-center mt-4">
    <hr>
    <p class="small text-muted mb-2">Or</p>
    <a href="<?= base_url('employee/login') ?>" class="btn btn-outline-secondary w-100">
      <i class="bi bi-people-fill"></i> Employee Login
    </a>
  </div>

  <p class="text-center mt-3 mb-0 small">
    Don’t have an account? 
    <a href="<?= base_url('register') ?>" class="text-decoration-none">Register here</a>
  </p>
</div>

</body>
</html>

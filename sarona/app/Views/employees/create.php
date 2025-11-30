<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0"><i class="bi bi-person-plus-fill"></i> Add Employee</h4>
        </div>

        <form action="<?= site_url('employees/store') ?>" method="post" class="p-4">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Enter full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Position</label>
                <input type="text" name="position" class="form-control" placeholder="Enter position" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Salary</label>
                <input type="number" name="salary" class="form-control" placeholder="Enter salary" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Department</label>
                <select name="department_id" class="form-select" required>
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= $dept['id'] ?>"><?= esc($dept['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-2">
                <i class="bi bi-check-circle"></i> Save Employee
            </button>
        </form>
    </div>
</div>

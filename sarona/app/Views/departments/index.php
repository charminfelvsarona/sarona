<?= $this->include('layouts/header') ?>

<div class="content">
  <div class="container-fluid">

    <?php if (session()->getFlashdata('message')): ?>
      <?= view('partials/toast', [
          'message' => session()->getFlashdata('message'),
          'alertType' => session()->getFlashdata('alertType')
      ]) ?>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-primary mb-0">Departments</h2>
      <a href="<?= site_url('departments/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Department
      </a>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-bordered align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Department Name</th>
              <th>Description</th>
              <th width="160">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($departments as $row): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= esc($row['name']) ?></td>
                <td><?= esc($row['description']) ?></td>
                <td>
                  <a href="<?= site_url('departments/edit/'.$row['id']) ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                  </a>
                  <a href="<?= site_url('departments/delete/'.$row['id']) ?>" class="btn btn-danger btn-sm"
                     onclick="return confirm('Delete this department?')">
                    <i class="bi bi-trash"></i> Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?= $this->include('layouts/footer') ?>

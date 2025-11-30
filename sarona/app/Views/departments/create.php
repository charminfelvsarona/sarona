<?= $this->include('layouts/header') ?>

<div class="content">
  <div class="container-fluid">

    <?php if (session()->getFlashdata('message')): ?>
      <?= view('partials/toast', [
          'message' => session()->getFlashdata('message'),
          'alertType' => session()->getFlashdata('alertType')
      ]) ?>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add Department</h4>
      </div>
      <div class="card-body">
        <form action="<?= site_url('departments/store') ?>" method="post">
          <?= csrf_field() ?>
          
          <div class="mb-3">
            <label class="form-label fw-bold">Department Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter department name" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Enter department description"></textarea>
          </div>

          <div class="d-flex justify-content-between">
            <a href="<?= site_url('departments') ?>" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Save Department
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<?= $this->include('layouts/footer') ?>

<?= $this->include('layouts/header') ?>

<div class="content">
  <div class="container-fluid">
    <h2 class="fw-bold text-primary mb-4">Reports Overview</h2>

    <!-- 🔹 Analytics Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="card text-center shadow-sm border-primary">
          <div class="card-body">
            <h5 class="card-title text-primary">Total Departments</h5>
            <h3><?= count($report) ?></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-center shadow-sm border-success">
          <div class="card-body">
            <h5 class="card-title text-success">Total Employees</h5>
            <h3><?= array_sum(array_column($report, 'total_employees')) ?></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-center shadow-sm border-warning">
          <div class="card-body">
            <h5 class="card-title text-warning">Total Salary (₱)</h5>
            <h3>₱<?= number_format(array_sum(array_column($report, 'total_salary')), 2) ?></h3>
          </div>
        </div>
      </div>
    </div>

    <!-- 🔹 Data Table -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="fw-bold mb-3">Department Salary & Employee Breakdown</h5>
        <table class="table table-bordered align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th>Department</th>
              <th>Total Employees</th>
              <th>Total Salary (₱)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($report as $row): ?>
              <tr>
                <td><?= $row['department'] ?? 'Unassigned' ?></td>
                <td><?= $row['total_employees'] ?></td>
                <td><?= number_format($row['total_salary'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- 🔹 Charts -->
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title text-center">Employee Count by Department</h5>
            <canvas id="employeeChart"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title text-center">Salary Distribution by Department</h5>
            <canvas id="salaryChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Prepare data from PHP
  const departments = <?= json_encode(array_column($report, 'department')) ?>;
  const employeeCounts = <?= json_encode(array_column($report, 'total_employees')) ?>;
  const salaryTotals = <?= json_encode(array_column($report, 'total_salary')) ?>;

  // Bar Chart - Employee Count
  const ctx1 = document.getElementById('employeeChart');
  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: departments,
      datasets: [{
        label: 'Employees',
        data: employeeCounts,
        backgroundColor: '#0d6efd'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Employee Count by Department'
        }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Pie Chart - Salary Distribution
  const ctx2 = document.getElementById('salaryChart');
  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: departments,
      datasets: [{
        label: 'Total Salary',
        data: salaryTotals,
        backgroundColor: [
          '#0d6efd',
          '#198754',
          '#ffc107',
          '#dc3545',
          '#6f42c1',
          '#20c997'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Salary Distribution by Department'
        }
      }
    }
  });
</script>

<?= $this->include('layouts/footer') ?>

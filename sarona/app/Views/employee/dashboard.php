<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Payslip Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; }

    .sidebar {
      height: 100vh;
      width: 230px;
      position: fixed;
      background-color: #198754;
      color: #fff;
      padding-top: 20px;
    }
    .sidebar a {
      display: block;
      color: #fff;
      padding: 12px 20px;
      text-decoration: none;
      font-weight: 500;
    }
    .sidebar a:hover { background-color: #157347; border-radius: 5px; }

    .main-content { margin-left: 250px; padding: 40px; }

    .payslip-card { max-width: 700px; margin: auto; }
    .payslip-card h4 { color: #198754; font-weight: 700; }
    .payslip-section { background: #fff; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
    .payslip-details { width: 100%; border: 1px solid #dee2e6; border-radius: 10px; background-color: #fefefe; padding: 20px; }
    .payslip-details th, .payslip-details td { padding: 8px; border-bottom: 1px solid #dee2e6; }
    .payslip-details th { width: 40%; text-align: left; }
    .payslip-summary { text-align: center; font-weight: 600; color: #198754; margin-top: 15px; }

    @media print {
      body * { visibility: hidden; }
      #payslipResult, #payslipResult * { visibility: visible; }
      #payslipResult { position: absolute; left: 0; top: 0; width: 100%; padding: 40px; }
      #payslipResult button, .sidebar, form { display: none !important; }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="text-center mb-4">
    <i class="bi bi-person-circle fs-1"></i>
    <h5 class="mt-2">Employee Panel</h5>
  </div>
  <a href="#"><i class="bi bi-receipt"></i> Payslip Generator</a>
  <a href="#"><i class="bi bi-person-lines-fill"></i> Profile</a>
  <a href="#"><i class="bi bi-gear"></i> Settings</a>
  <a href="<?= base_url('/') ?>" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="payslip-card">
    <div class="payslip-section p-4">
      <h4 class="text-center mb-3"><i class="bi bi-receipt-cutoff"></i> Employee Payslip Generator</h4>

      <form id="payslipForm" class="mb-4">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" id="fullname" class="form-control" placeholder="Enter full name" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Position</label>
            <input type="text" id="position" class="form-control" placeholder="Enter position" required>
          </div>
        </div>
        <button type="submit" class="btn btn-success w-100">
          <i class="bi bi-calculator"></i> Generate Payslip
        </button>
      </form>

      <div id="payslipResult" class="border-top pt-4" style="display:none;">
        <div class="text-center mb-3">
          <h5 class="fw-bold text-success">PAYSLIP</h5>
          <small class="text-muted">Generated on: <span id="payslipDate"></span></small>
          <hr>
        </div>

        <table class="table table-borderless payslip-details">
          <tr><th>Full Name:</th><td id="displayName"></td></tr>
          <tr><th>Position:</th><td id="displayPosition"></td></tr>
          <tr><th>Base Salary:</th><td id="displaySalary"></td></tr>
          <tr><th>Tax (10%):</th><td id="displayTax"></td></tr>
          <tr><th>Net Salary:</th><td id="displayNet"></td></tr>
        </table>

        <div class="payslip-summary">
          <p>Thank you for your hard work and dedication!</p>
        </div>

        <div class="text-center">
          <button class="btn btn-outline-primary mt-3" onclick="window.print()">
            <i class="bi bi-printer"></i> Print Payslip
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById("payslipForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("fullname").value.trim();
    const position = document.getElementById("position").value.trim();

    fetch("<?= site_url('payslip/generate') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ fullname: name, position: position })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            const emp = data.employee;
            const salary = parseFloat(emp.salary);
            const tax = salary * 0.10;
            const net = salary - tax;

            document.getElementById("displayName").textContent = emp.fullname;
            document.getElementById("displayPosition").textContent = emp.position;
            document.getElementById("displaySalary").textContent = "₱" + salary.toLocaleString();
            document.getElementById("displayTax").textContent = "₱" + tax.toLocaleString();
            document.getElementById("displayNet").textContent = "₱" + net.toLocaleString();
            document.getElementById("payslipDate").textContent = new Date().toLocaleDateString();

            document.getElementById("payslipResult").style.display = "block";
        } else {
            alert("❌ " + data.message);
        }
    })
    .catch(err => console.error(err));
});
</script>

</body>
</html>

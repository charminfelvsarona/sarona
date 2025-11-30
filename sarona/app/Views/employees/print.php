<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Employee List</title>
  <style>
    body {
      font-family: "Poppins", Arial, sans-serif;
      background-color: #fff;
      color: #333;
      margin: 40px;
    }

    h2 {
      text-align: center;
      color: #0d6efd;
      margin-bottom: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h1 {
      margin: 0;
      color: #0d6efd;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      font-size: 14px;
    }

    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #0d6efd;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .footer {
      text-align: right;
      margin-top: 40px;
      font-size: 13px;
      color: #555;
    }

    @media print {
      body {
        margin: 0;
      }
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body onload="window.print()">

  <div class="header">
    <h1>Employee Management System</h1>
    <p><strong>Generated on:</strong> <?= date('F d, Y h:i A') ?></p>
  </div>

  <h2>Employee List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($employees as $e): ?>
            <tr>
                <td><?= esc($e['id']) ?></td>
                <td><?= esc($e['fullname']) ?></td>
                <td><?= esc($e['position']) ?></td>
                <td><?= esc($e['salary']) ?></td>
                <td><?= esc($e['department']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

  <div class="footer">
    <p>Printed by: <?= session()->get('username') ?? 'Administrator' ?></p>
  </div>

</body>
</html>

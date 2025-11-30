<?php
$alertType = $alertType ?? 'info';
$bgColor = [
  'success' => '#28a745',
  'info' => '#0dcaf0',
  'danger' => '#dc3545',
  'warning' => '#ffc107'
][$alertType] ?? '#0dcaf0';
?>
<div id="toast" 
     style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            background-color: <?= $bgColor ?>; color: white;
            padding: 15px 25px; border-radius: 8px; font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); z-index: 9999;
            opacity: 0; transition: opacity 0.4s ease;">
  <?= esc($message) ?>
</div>

<script>
  const toast = document.getElementById('toast');
  if (toast) {
    setTimeout(() => toast.style.opacity = '1', 100);
    setTimeout(() => toast.style.opacity = '0', 3000);
  }
</script>

<?php
$currentPage = basename($_SERVER['PHP_SELF']);
// ---------- แถบเมนูล่าง ----------
$navItems = [
    ['label' => 'หน้าหลัก',    'icon' => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/>', 'url' => 'index.php'],
    ['label' => 'บัญชี',       'icon' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>', 'url' => 'login.php'],
    ['label' => 'ข้อความ',     'icon' => '<path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>', 'url' => 'notifications.php'],
    ['label' => 'บริการอื่นๆ', 'icon' => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>', 'url' => 'services.php'],
];
?>
<div class="navbar">
  <?php foreach ($navItems as $nav): 
    $isActive = (!empty($nav['url']) && $currentPage == $nav['url']);
    $servicePages = ['services.php', 'loan_calculator.php', 'settings.php'];
    if (in_array($currentPage, $servicePages) && !empty($nav['url']) && $nav['url'] === 'services.php') {
        $isActive = true;
    }
    $onclick = "setActiveNav(this)";
    if (!empty($nav['url'])) {
        $onclick = "window.location.href='" . htmlspecialchars($nav['url']) . "'";
    }
  ?>
  <div class="navitem<?= $isActive ? ' active' : '' ?>" onclick="<?= $onclick ?>" data-label="<?= htmlspecialchars($nav['label']) ?>">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><?= $nav['icon'] ?></svg>
    <span><?= htmlspecialchars($nav['label']) ?></span>
  </div>
  <?php endforeach; ?>
</div>

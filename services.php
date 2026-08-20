<?php
// services.php
$menuCategories = [
    'บริการหลัก' => [
        ['label' => 'แจ้งการ<br>โอนเงิน',  'image' => 'แจ้งการโอนเงิน-removebg-preview.png'],
        ['label' => 'การถอนเงิน/<br>แจ้งเงินฝาก', 'image' => 'การถอนเงิน-removebg-preview.png'],
        ['label' => 'เงินฝาก',            'image' => 'การออมเงิน-removebg-preview.png'],
        ['label' => 'ใบเสร็จ',            'image' => 'ใบเสร็จอิเล็กทรอนิกส์-removebg-preview (1).png'],
    ],
    'สินเชื่อและหุ้น' => [
        ['label' => 'เงินกู้',             'image' => 'เงินกู้-removebg-preview.png'],
        ['label' => 'ฉุกเฉิน<br>ออนไลน์',   'image' => 'กู้ออนไลน์-removebg-preview.png'],
        ['label' => 'คำนวณ<br>เงินกู้',    'image' => 'กู้ออนไลน์-removebg-preview.png', 'url' => 'loan_calculator.php'],
        ['label' => 'การ<br>ค้ำประกัน',    'image' => 'ค้ำประกัน-removebg-preview.png'],
        ['label' => 'หุ้น<br>รายเดือน',    'image' => 'หุ้นรายเดือน-removebg-preview.png'],
    ],
    'ข้อมูลสมาชิก' => [
        ['label' => 'ข้อมูล<br>ส่วนตัว',   'image' => 'ข้อมูลส่วนตัว-removebg-preview.png', 'url' => 'profile.php'],
        ['label' => 'แจ้งเตือน',          'image' => '13-removebg-preview.png', 'url' => 'notifications.php'],
        ['label' => 'กรรมการ',            'image' => 'กรรมการ-removebg-preview.png'],
        ['label' => 'ฝ่าย<br>จัดการ',      'image' => 'ฝ่ายจัดการ-removebg-preview.png'],
    ]
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>บริการทั้งหมด</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --orange-deep:#F5652B;
    --orange:#FA8A46;
    --orange-light:#FFC08A;
    --peach:#FFE9D2;
    --navy:#1C3A5E;
    --navy-deep:#132A44;
    --blue:#3E7BFA;
    --purple:#8C6FF0;
    --red:#EB5757;
    --green:#2FAE7B;
    --text:#2B2B2B;
    --text-muted:#8A8A8A;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body, html {
    margin: 0; padding: 0;
    font-family: 'Noto Sans Thai', sans-serif;
    background-color: var(--bg, #f3f4f6);
    min-height: 100vh;
  }
  .app-container {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    background: #fff;
    height: 100vh;
    height: 100dvh;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
  }

  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:#000;}

  .topbar{display:flex;align-items:center;justify-content:space-between;padding:60px 24px 20px;}
  .back-btn{cursor:pointer;display:flex;align-items:center;justify-content:center;}
  .topbar-title{font-size:16px;font-weight:700;color:var(--text);}
  .placeholder{width:24px;}

  .scroll{flex:1;overflow-y:auto;padding-bottom:100px;}
  .scroll::-webkit-scrollbar{width:0;}

  .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px 0;padding:16px 12px 10px;}
  .category-title{font-size:14px;font-weight:700;color:var(--navy-deep);padding:24px 18px 0;margin-bottom:-6px;}
  .tile{display:flex;flex-direction:column;align-items:center;gap:0;text-align:center;cursor:pointer;-webkit-tap-highlight-color:transparent;}
  .tile-icon{width:85px;height:85px;max-width:100%;aspect-ratio:1;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:transform .15s ease;}
  .tile-icon img{width:100%;height:100%;object-fit:contain;display:block;}
  .tile:hover .tile-icon{transform:translateY(-3px);box-shadow:0 10px 18px -6px rgba(0,0,0,.28);}
  .tile:active .tile-icon{transform:translateY(0) scale(.92);}
  .tile-label{font-size:11px;color:var(--text);line-height:1.1;font-weight:500;margin-top:-4px;}

  .bg-orange{background:linear-gradient(160deg,#FFB37A,var(--orange-deep));color:#fff;}
  .bg-blue{background:linear-gradient(160deg,#7FA6FF,var(--blue));color:#fff;}
  .bg-purple{background:linear-gradient(160deg,#B6A3FF,var(--purple));color:#fff;}
  .bg-red{background:linear-gradient(160deg,#FF9E9E,var(--red));color:#fff;}
  .bg-green{background:linear-gradient(160deg,#7FDBB2,var(--green));color:#fff;}

  /* Bottom Nav (from index.php) */
  .navbar{position:absolute;bottom:0;left:0;right:0;display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:#F5652B;}
  .navitem span{font-size:10.5px;font-weight:600;}

  .toast{
    position:absolute;left:50%;bottom:96px;transform:translateX(-50%) translateY(12px);
    background:rgba(28,28,28,.92);color:#fff;font-size:12.5px;font-weight:600;
    padding:10px 16px;border-radius:24px;white-space:nowrap;
    opacity:0;pointer-events:none;transition:opacity .18s ease, transform .18s ease;z-index:80;
    box-shadow:0 10px 24px -8px rgba(0,0,0,.5);
  }
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

  @media (max-width: 480px) {
    .app-container {
      box-shadow: none;
    }
    .navbar {
      position: sticky;
      bottom: 0;
      z-index: 60;
    }
  }

  @media (max-width: 400px), (max-height: 750px) {
    .topbar { padding: 40px 16px 12px; }
    .page-title, .topbar-title { font-size: 16px; }
    .navbar { padding: 10px 4px; }
    .navitem span { font-size: 9.5px; }
    .grid { gap: 10px 0; padding: 12px 8px; }
    .tile-icon { width: 65px; height: 65px; }
  }
</style>
</head>
<body>
<div class="app-container">
    <div class="scroll">
      

      <div class="topbar">
        <div class="back-btn" onclick="window.location.href='index.php'">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1C1C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </div>
        <div class="topbar-title">บริการทั้งหมด</div>
        <div class="placeholder"></div>
      </div>

      <?php foreach ($menuCategories as $catName => $items): ?>
      <div class="category-title"><?= htmlspecialchars($catName) ?></div>
      <div class="grid">
        <?php 
          foreach ($items as $item): 
            $itemText = strip_tags(str_replace('<br>', ' ', $item['label'])); 
            $onclick = !empty($item['url']) ? "window.location.href='{$item['url']}'" : "go('{$itemText}')";
        ?>
        <div class="tile" onclick="<?= $onclick ?>">
          <div class="tile-icon" style="background:transparent; box-shadow:none;">
            <img src="image/main/<?= htmlspecialchars($item['image']) ?>" alt="" style="width:100%; height:100%; object-fit:contain;">
          </div>
          <div class="tile-label"><?= $item['label'] ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <?php include 'nav_footer.php'; ?>

    <div class="toast" id="toast"></div>
</div>

<script>
  let toastTimer = null;
  function go(label){
    const el = document.getElementById('toast');
    el.textContent = 'เปิดหน้า: ' + label;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => el.classList.remove('show'), 1600);
  }
</script>
</body>
</html>

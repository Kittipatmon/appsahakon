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
        ['label' => 'ข้อมูล<br>ส่วนตัว',   'image' => 'ข้อมูลส่วนตัว-removebg-preview.png'],
        ['label' => 'แจ้งเตือน',          'image' => '13-removebg-preview.png'],
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
  body{
    background:#f3f4f6;
    font-family:'Noto Sans Thai',sans-serif;
    display:flex;align-items:flex-start;justify-content:center;
    padding:40px 16px;min-height:100vh;
  }
  .stage{display:flex;flex-direction:column;align-items:center;gap:18px;}
  
  .phone{
    width:390px;height:844px;
    background:#fff;
    border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:#000;}

  .topbar{display:flex;align-items:center;justify-content:space-between;padding:12px 24px 20px;}
  .back-btn{cursor:pointer;display:flex;align-items:center;justify-content:center;}
  .topbar-title{font-size:16px;font-weight:700;color:var(--text);}
  .placeholder{width:24px;}

  .scroll{flex:1;overflow-y:auto;padding-bottom:100px;}
  .scroll::-webkit-scrollbar{width:0;}

  .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px 6px;padding:16px 18px 10px;}
  .category-title{font-size:14px;font-weight:700;color:var(--navy-deep);padding:24px 18px 0;margin-bottom:-6px;}
  .tile{display:flex;flex-direction:column;align-items:center;gap:0;text-align:center;cursor:pointer;-webkit-tap-highlight-color:transparent;}
  .tile-icon{width:68px;height:68px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:transform .15s ease;}
  .tile:hover .tile-icon{transform:translateY(-3px);box-shadow:0 10px 18px -6px rgba(0,0,0,.28);}
  .tile:active .tile-icon{transform:translateY(0) scale(.92);}
  .tile-label{font-size:11px;color:var(--text);line-height:1.3;font-weight:500;margin-top:-4px;}

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

  /* Responsive layout for Mobile & iPad */
  @media (max-width: 1024px) {
    body {
      padding: 0;
      background: #fff;
    }
    .caption {
      display: none;
    }
    .phone {
      width: 100vw;
      height: 100vh;
      border: none;
      border-radius: 0;
      box-shadow: none;
    }
    .notch {
      display: none;
    }
    .status {
      display: none;
    }
    .topbar {
      padding-top: 32px;
    }
    .scroll {
      padding-bottom: 80px;
    }
    .navbar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 60;
    }
  }
</style>
</head>
<body>
<div class="stage">
  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="status">
        <span>9:41</span>
        <span>●●●● 5G ▮▮▮</span>
      </div>

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

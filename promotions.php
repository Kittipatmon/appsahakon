<?php
// promotions.php
$promos = [
    [
        'title'    => 'โปรอัตราดอกเบี้ยเงินฝากพิเศษ',
        'subtitle' => 'สำหรับสมาชิกใหม่ ระยะเวลาจำกัด<br>ถึง 30 กันยายน 2569',
        'rate'     => '3.25%',
        'rate_sub' => 'ต่อปี',
        'bg_image' => 'image/promot/promo1.png'
    ],
    [
        'title'    => 'สินเชื่อสวัสดิการเพื่อที่อยู่อาศัย',
        'subtitle' => 'ผ่อนสบาย ดอกเบี้ยลดต้นลดดอก<br>อนุมัติไว',
        'rate'     => '4.50%',
        'rate_sub' => 'ต่อปี',
        'bg_image' => 'image/promot/promo2.png'
    ],
    [
        'title'    => 'สมัครสมาชิกรับของที่ระลึก',
        'subtitle' => 'และสิทธิพิเศษมากมาย<br>ฟรีค่าธรรมเนียมแรกเข้า',
        'rate'     => 'Free',
        'rate_sub' => 'สิทธิพิเศษ',
        'bg_image' => ''
    ],
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>โปรโมชันพิเศษ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --orange-deep:#F5652B;
    --orange:#FA8A46;
    --navy:#1C3A5E;
    --navy-deep:#132A44;
    --blue:#3E7BFA;
    --text:#2B2B2B;
    --text-muted:#8A8A8A;
    --bg:#f3f4f6;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body, html {
    margin: 0; padding: 0;
    font-family: 'Noto Sans Thai', sans-serif;
    background-color: var(--bg);
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
  @media (min-width: 481px) {
    .app-container {
      margin: 20px auto;
      height: calc(100vh - 40px);
      border-radius: 24px;
      border: 1px solid #E5E7EB;
    }
  }
  .scroll{flex:1;overflow-y:auto;background:var(--bg);padding-bottom:100px;}
  .header-sticky {
    background: #ffffff;
    position: sticky;
    top: 0;
    z-index: 10;
    padding-bottom: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  }
  .topbar { display:flex; align-items:center; justify-content:space-between; padding: 36px 20px 0; }
  .topbar-center { text-align:center; flex:1; }
  .page-title { font-size: 18px; font-weight: 700; color: var(--navy-deep); }
  .placeholder, .back-btn { width: 40px; display:flex; align-items:center; justify-content:center; }
  .back-btn {
    color: var(--navy-deep);
    cursor: pointer;
    transition: background 0.15s, transform 0.15s ease;
    border-radius: 50%;
    height: 40px;
    -webkit-tap-highlight-color: transparent;
  }
  .back-btn:hover { background: rgba(0,0,0,0.04); }
  
  .promo-list {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .promo {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--navy-deep);
    border-radius: 18px;
    padding: 20px 18px;
    box-shadow: 0 8px 16px -8px rgba(19,42,68,.6);
    cursor: pointer;
    box-sizing: border-box;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
  }
  .promo:active {
    transform: scale(0.98);
  }
  .promo-icon{
    width:52px;
    height:52px;
    border-radius:50%;
    background:rgba(255,255,255,.1);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    color:#FFC98B;
  }
  .promo-text{
    color:#fff;
    margin-left:14px;
    flex: 1;
  }
  .promo-text .t1{
    font-size:14px;
    font-weight:700;
  }
  .promo-text .t2{
    font-size:11.5px;
    color:#C9D6E8;
    margin-top:4px;
    line-height:1.4;
  }
  .promo-rate{
    margin-left:auto;
    text-align:right;
    color:#FFC98B;
    font-weight:800;
    font-size:17px;
    flex-shrink:0;
  }
  .promo-rate span{
    display:block;
    font-size:10px;
    color:#C9D6E8;
    font-weight:500;
  }

  .navbar{display:flex;justify-content:space-around;align-items:center;padding:14px 6px;background:#fff;border-top:1px solid #F0F0F0;position:absolute;bottom:0;left:0;right:0;z-index:50;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  .toast{
    position:absolute;left:50%;bottom:96px;transform:translateX(-50%) translateY(12px);
    background:rgba(28,28,28,.92);color:#fff;font-size:12.5px;font-weight:600;
    padding:10px 16px;border-radius:24px;white-space:nowrap;
    opacity:0;pointer-events:none;transition:opacity .18s ease, transform .18s ease;z-index:80;
    box-shadow:0 10px 24px -8px rgba(0,0,0,.5);
  }
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0);}
  ::-webkit-scrollbar{width:0;}
  
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
    .topbar { padding: 20px 16px 0; }
    .page-title { font-size: 16px; }
    .navbar { padding: 10px 4px; }
    .navitem span { font-size: 9.5px; }
    .promo-list { padding: 12px; gap: 12px; }
    .promo { padding: 12px; }
    .promo-icon { width: 40px; height: 40px; }
  }
</style>
</head>
<body>
<div class="app-container">
  <div class="header-sticky">
    <div class="topbar">
      <div class="back-btn" onclick="window.history.back()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </div>
      <div class="topbar-center">
        <div class="page-title">โปรโมชันพิเศษ</div>
      </div>
      <div class="placeholder"></div>
    </div>
  </div>
  
  <div class="scroll">
    <div class="promo-list">
      <?php foreach ($promos as $promo): 
          $bgStyle = !empty($promo['bg_image']) ? "background: linear-gradient(90deg, rgba(19,42,68,0.95) 0%, rgba(19,42,68,0.7) 50%, rgba(19,42,68,0) 100%), url('{$promo['bg_image']}') right center/cover no-repeat;" : "background: var(--navy-deep);";
      ?>
      <div class="promo" onclick="go('<?= htmlspecialchars($promo['title']) ?>')" style="<?= $bgStyle ?>">
        <div class="promo-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="13" r="8"/><path d="M12 9v4l3 2"/><path d="M9 2h6"/></svg>
        </div>
        <div class="promo-text">
          <div class="t1"><?= htmlspecialchars($promo['title']) ?></div>
          <div class="t2"><?= $promo['subtitle'] ?></div>
        </div>
        <div class="promo-rate"><?= htmlspecialchars($promo['rate']) ?><span><?= htmlspecialchars($promo['rate_sub']) ?></span></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <?php include 'nav_footer.php'; ?>
  <div class="toast" id="toast"></div>
</div>

<script>
  let toastTimer = null;
  function go(label){
    const el = document.getElementById('toast');
    el.textContent = 'ดูรายละเอียด: ' + label;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => el.classList.remove('show'), 1600);
  }
  
  function setActiveNav(el) {
    if(el.dataset.label) {
      // nav redirect handled in nav_footer.php
    }
  }
</script>
</body>
</html>

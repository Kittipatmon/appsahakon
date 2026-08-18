<?php
/**
 * สหกรณ์ออมทรัพย์ครูไทย — หน้าหลัก (UI mockup)
 * แปลงจากไฟล์ HTML ต้นแบบเป็น PHP โดยดึงข้อมูลสมาชิก/เมนู/ข่าวสาร
 * ออกมาเป็นตัวแปร/อาเรย์ ด้านบนไฟล์ เพื่อให้เชื่อมกับฐานข้อมูลจริงได้ง่ายในภายหลัง
 */

// ---------- ข้อมูลสมาชิก (ตัวอย่าง mock data) ----------
$member = [
    'initials'   => 'วภ',
    'name'       => 'ครูวิภา ใจงาม',
    'member_no'  => '00184627',
    'has_notify' => true,
];

// ---------- แบนเนอร์โปรโมชั่น ----------
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

// ---------- ปุ่มลัด 2 ช่อง ----------
$quickActions = [
    [
        'label' => 'ฝากเงิน<br>ด้วยตนเอง',
        'icon'  => '<path d="M12 19V5"/><path d="M5 12l7-7 7 7"/>',
    ],
    [
        'label' => 'ถอนเงิน<br>ผ่านตนเอง',
        'icon'  => '<path d="M12 5v14"/><path d="M19 12l-7 7-7-7"/>',
    ],
];

// ---------- กริดเมนูหลัก (จากชุดไอคอนที่มีในระบบ) ----------
$menuItems = [
    ['label' => 'แจ้งการ<br>โอนเงิน',  'image' => 'แจ้งการโอนเงิน-removebg-preview.png'],
    ['label' => 'ใบเสร็จ',            'image' => 'ใบเสร็จอิเล็กทรอนิกส์-removebg-preview (1).png'],
    ['label' => 'ฉุกเฉิน<br>ออนไลน์',   'image' => 'กู้ออนไลน์-removebg-preview.png'],
    ['label' => 'การถอนเงิน/<br>แจ้งเงินฝาก', 'image' => 'การถอนเงิน-removebg-preview.png'],
];

// ---------- ข่าวสาร ----------
$news = [
    'title'    => 'ประกาศอัตราดอกเบี้ยเงินฝากใหม่',
    'subtitle' => 'มีผลตั้งแต่ 1 กันยายน 2569 เป็นต้นไป',
];

?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สหกรณ์ออมทรัพย์ครูไทย — UI Design</title>
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
    background:#0e1420;
    font-family:'Noto Sans Thai',sans-serif;
    display:flex;align-items:flex-start;justify-content:center;
    padding:40px 16px;min-height:100vh;
  }
  .stage{display:flex;flex-direction:column;align-items:center;gap:18px;}
  .caption{color:#8a93a6;font-size:12px;letter-spacing:.08em;text-transform:uppercase;}

  .phone{
    width:390px;height:844px;
    background:#fff;
    border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .scroll{flex:1;overflow-y:auto;background:linear-gradient(180deg,var(--orange-deep) 0%,var(--orange) 20%,var(--orange-light) 38%,var(--peach) 55%,#ffffff 72%);}

  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:#fff;}

  .header{padding:10px 20px 6px;}
  .header-row{display:flex;align-items:center;justify-content:space-between;}
  .member{display:flex;align-items:center;gap:10px;}
  .avatar{width:42px;height:42px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;color:var(--orange-deep);font-weight:700;font-size:15px;border:2px solid rgba(255,255,255,.7);}
  .member-name{font-size:14.5px;font-weight:700;color:#fff;}
  .member-id{font-size:11px;color:rgba(255,255,255,.85);margin-top:1px;}
  .header-icons{display:flex;gap:10px;}
  .icon-btn{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;position:relative;cursor:pointer;transition:transform .15s ease, background .15s ease;}
  .icon-btn:hover{background:rgba(255,255,255,.34);}
  .icon-btn:active{transform:scale(.92);}
  .dot{position:absolute;top:5px;right:5px;width:6px;height:6px;border-radius:50%;background:#fff;border:1.5px solid var(--orange);}
  .avatar{cursor:pointer;transition:transform .15s ease;}
  .avatar:active{transform:scale(.92);}

  .promo{cursor:pointer;transition:transform .15s ease, box-shadow .15s ease;margin:14px 18px 0;background:linear-gradient(120deg,var(--navy) 0%,var(--navy-deep) 100%);border-radius:16px;padding:14px 14px;display:flex;align-items:center;gap:12px;box-shadow:0 10px 22px -10px rgba(19,42,68,.6);}
  .promo:hover{transform:translateY(-2px);box-shadow:0 14px 26px -10px rgba(19,42,68,.7);}
  .promo:active{transform:translateY(0) scale(.98);}
  .promo-icon{width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#FFC98B;}
  .promo-text{color:#fff;}
  .promo-text .t1{font-size:12.5px;font-weight:700;}
  .promo-text .t2{font-size:10.5px;color:#C9D6E8;margin-top:2px;line-height:1.4;}
  .promo-rate{margin-left:auto;text-align:right;color:#FFC98B;font-weight:800;font-size:15px;flex-shrink:0;}
  .promo-rate span{display:block;font-size:9px;color:#C9D6E8;font-weight:500;}

  .quick{margin:14px 18px 0;background:#fff;border-radius:16px;display:flex;box-shadow:0 10px 24px -14px rgba(0,0,0,.25);overflow:hidden;}
  .quick a{flex:1;display:flex;align-items:center;gap:9px;padding:13px 12px;text-decoration:none;position:relative;cursor:pointer;transition:background .15s ease;}
  .quick a:hover{background:#FAFAFA;}
  .quick a:active{background:#F2F2F2;}
  .quick a:first-child::after{content:"";position:absolute;right:0;top:14%;bottom:14%;width:1px;background:#EEE;}
  .qicon{width:36px;height:36px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .qlabel{font-size:12px;font-weight:600;color:var(--text);line-height:1.3;}
  .qchev{margin-left:auto;color:#C7C7C7;transition:transform .15s ease;}
  .quick a:hover .qchev{transform:translateX(2px);}

  .panel{background:#fff;border-radius:22px 22px 0 0;margin-top:16px;padding:20px 18px 4px;}
  .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px 6px;}
  .tile{display:flex;flex-direction:column;align-items:center;gap:0;text-align:center;cursor:pointer;-webkit-tap-highlight-color:transparent;}
  .tile-icon{width:68px;height:68px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:transform .15s ease;}
  .tile:hover .tile-icon{transform:translateY(-3px);box-shadow:0 10px 18px -6px rgba(0,0,0,.28);}
  .tile:active .tile-icon{transform:translateY(0) scale(.92);}
  .tile-label{font-size:11px;color:var(--text);line-height:1.3;font-weight:500;margin-top:-4px;}

  .menu-head{display:flex;align-items:center;justify-content:space-between;margin:0 4px 16px;}
  .menu-title{font-size:15px;font-weight:800;color:var(--navy-deep);}
  .menu-all{font-size:12.5px;color:#185368;font-weight:600;cursor:pointer;}
  .menu-all:hover{text-decoration:underline;}

  .bg-orange{background:linear-gradient(160deg,#FFB37A,var(--orange-deep));color:#fff;}
  .bg-blue{background:linear-gradient(160deg,#7FA6FF,var(--blue));color:#fff;}
  .bg-purple{background:linear-gradient(160deg,#B6A3FF,var(--purple));color:#fff;}
  .bg-red{background:linear-gradient(160deg,#FF9E9E,var(--red));color:#fff;}
  .bg-green{background:linear-gradient(160deg,#7FDBB2,var(--green));color:#fff;}

  .news-head{display:flex;align-items:center;justify-content:space-between;margin:22px 0 10px;}
  .news-title{font-size:14.5px;font-weight:700;color:var(--text);}
  .news-all{font-size:11.5px;color:var(--orange-deep);font-weight:600;cursor:pointer;}
  .news-all:hover{text-decoration:underline;}
  .promo-wrapper { position: relative; margin: 20px 20px 0; display: grid; }
  .promo { grid-area: 1 / 1; display: flex; align-items: center; background: var(--navy-deep); border-radius: 18px; padding: 16px 18px; box-shadow: 0 12px 24px -10px rgba(19,42,68,.6); cursor: pointer; box-sizing: border-box; opacity: 0; transition: opacity 0.8s ease; pointer-events: none; z-index: 1; }
  .promo.active { opacity: 1; pointer-events: auto; z-index: 2; }
  .promo-icon{width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#FFC98B;}
  .promo-text{color:#fff;margin-left:12px;}
  .promo-text .t1{font-size:12.5px;font-weight:700;}
  .promo-text .t2{font-size:10.5px;color:#C9D6E8;margin-top:2px;line-height:1.4;}
  .promo-rate{margin-left:auto;text-align:right;color:#FFC98B;font-weight:800;font-size:15px;flex-shrink:0;}
  .promo-rate span{display:block;font-size:9px;color:#C9D6E8;font-weight:500;}
  .news-card{display:flex;gap:10px;align-items:center;background:#FFF6EE;border-radius:14px;padding:10px;margin-bottom:24px;cursor:pointer;transition:background .15s ease;}
  .news-card:hover{background:#FFEEDF;}
  .news-card:active{background:#FFE4CE;}
  .news-thumb{width:52px;height:52px;border-radius:10px;background:linear-gradient(140deg,var(--orange),var(--orange-deep));flex-shrink:0;}
  .news-body .n1{font-size:12px;font-weight:700;color:var(--text);}
  .news-body .n2{font-size:10.5px;color:var(--text-muted);margin-top:2px;}

  .navbar{display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0;flex-shrink:0;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  /* toast feedback for mock navigation */
  .toast{
    position:absolute;left:50%;bottom:96px;transform:translateX(-50%) translateY(12px);
    background:rgba(28,28,28,.92);color:#fff;font-size:12.5px;font-weight:600;
    padding:10px 16px;border-radius:24px;white-space:nowrap;
    opacity:0;pointer-events:none;transition:opacity .18s ease, transform .18s ease;z-index:80;
    box-shadow:0 10px 24px -8px rgba(0,0,0,.5);
  }
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

  ::-webkit-scrollbar{width:0;}
</style>
</head>
<body>
<div class="stage">
  <div class="caption">สหกรณ์ออมทรัพย์ครูไทย — หน้าหลัก (PHP template)</div>

  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="status">
        <span>9:41</span>
        <span>●●●● 5G ▮▮▮</span>
      </div>

      <div class="header">
        <div class="header-row">
          <div class="member" onclick="go('ข้อมูลส่วนตัว')">
            <div class="avatar"><?= htmlspecialchars($member['initials']) ?></div>
            <div>
              <div class="member-name">สวัสดีค่ะ, <?= htmlspecialchars($member['name']) ?></div>
              <div class="member-id">เลขสมาชิก <?= htmlspecialchars($member['member_no']) ?></div>
            </div>
          </div>
          <div class="header-icons">
            <div class="icon-btn" onclick="go('การแจ้งเตือน')">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
              <?php if ($member['has_notify']): ?><div class="dot"></div><?php endif; ?>
            </div>
            <div class="icon-btn" onclick="window.location.href='settings.php'">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.87l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.87-.34 1.7 1.7 0 0 0-1 1.55V21a2 2 0 1 1-4 0v-.09A1.7 1.7 0 0 0 9 19.4a1.7 1.7 0 0 0-1.87.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-1.55-1H3a2 2 0 1 1 0-4h.09A1.7 1.7 0 0 0 4.6 9a1.7 1.7 0 0 0-.34-1.87l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-1.55V3a2 2 0 1 1 4 0v.09a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.87-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.7 1.7 0 0 0 19.4 9a1.7 1.7 0 0 0 1.55 1H21a2 2 0 1 1 0 4h-.09a1.7 1.7 0 0 0-1.51 1z"/></svg>
            </div>
          </div>
        </div>
      </div>

      <div class="promo-wrapper" id="promoWrapper">
        <?php foreach ($promos as $index => $promo): 
            $bgStyle = !empty($promo['bg_image']) ? "background: linear-gradient(90deg, rgba(19,42,68,0.95) 0%, rgba(19,42,68,0.7) 50%, rgba(19,42,68,0) 100%), url('{$promo['bg_image']}') right center/cover no-repeat;" : "background: var(--navy-deep);";
            $activeClass = $index === 0 ? 'active' : '';
        ?>
        <div class="promo <?= $activeClass ?>" onclick="go('<?= htmlspecialchars($promo['title']) ?>')" style="<?= $bgStyle ?>">
          <div class="promo-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="13" r="8"/><path d="M12 9v4l3 2"/><path d="M9 2h6"/></svg>
          </div>
          <div class="promo-text">
            <div class="t1"><?= htmlspecialchars($promo['title']) ?></div>
            <div class="t2"><?= $promo['subtitle'] /* มี <br> ในเนื้อหา จึงไม่ escape */ ?></div>
          </div>
          <div class="promo-rate"><?= htmlspecialchars($promo['rate']) ?><span><?= htmlspecialchars($promo['rate_sub']) ?></span></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="quick">
        <?php foreach ($quickActions as $qa): $qaText = strip_tags(str_replace('<br>', ' ', $qa['label'])); ?>
        <a onclick="go('<?= htmlspecialchars($qaText) ?>')">
          <div class="qicon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><?= $qa['icon'] ?></svg></div>
          <div class="qlabel"><?= $qa['label'] ?></div>
          <div class="qchev">&#8250;</div>
        </a>
        <?php endforeach; ?>
      </div>

      <div class="panel">
        <div class="menu-head">
          <div class="menu-title">เมนูบริการของฉัน</div>
          <div class="menu-all" onclick="window.location.href='services.php'">ดูทั้งหมด</div>
        </div>
        <div class="grid">
          <?php foreach ($menuItems as $item): $itemText = strip_tags(str_replace('<br>', ' ', $item['label'])); ?>
          <div class="tile" onclick="go('<?= htmlspecialchars($itemText) ?>')">
            <div class="tile-icon" style="background:transparent; box-shadow:none;">
              <img src="image/main/<?= htmlspecialchars($item['image']) ?>" alt="" style="width:100%; height:100%; object-fit:contain;">
            </div>
            <div class="tile-label"><?= $item['label'] ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="news-head">
          <div class="news-title">ข่าวสาร</div>
          <div class="news-all" onclick="go('ข่าวสารทั้งหมด')">ดูทั้งหมด &#8250;</div>
        </div>
        <div class="news-card" onclick="go('<?= htmlspecialchars($news['title']) ?>')">
          <div class="news-thumb"></div>
          <div class="news-body">
            <div class="n1"><?= htmlspecialchars($news['title']) ?></div>
            <div class="n2"><?= htmlspecialchars($news['subtitle']) ?></div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'nav_footer.php'; ?>

    <div class="toast" id="toast"></div>
  </div>
</div>

<script>
  function go(page) {
    const t = document.getElementById('toast');
    t.innerText = 'กำลังไปหน้า: ' + page;
    t.classList.add('show');
    setTimeout(() => { t.classList.remove('show'); }, 2000);
  }
  // Auto crossfade promos
  const promos = document.querySelectorAll('#promoWrapper .promo');
  let currentPromoIdx = 0;
  if (promos.length > 1) {
    setInterval(() => {
      promos[currentPromoIdx].classList.remove('active');
      currentPromoIdx = (currentPromoIdx + 1) % promos.length;
      promos[currentPromoIdx].classList.add('active');
    }, 5000); // เปลี่ยนรูปอัตโนมัติทุก 5 วินาที
  }
  // แถบเมนูล่าง: สลับสถานะ active ไปตามแท็บที่กด แล้วแจ้งด้วย toast เดียวกัน
  function setActiveNav(el){
    document.querySelectorAll('.navitem').forEach(n => n.classList.remove('active'));
    el.classList.add('active');
    go(el.dataset.label);
  }
</script>
</body>
</html>

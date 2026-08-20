<?php
$member = [
    'initials'   => 'วภ',
    'name'       => 'ครูวิภา ใจงาม',
    'member_no'  => '00184627',
];

// ข้อมูลบัญชี (Mock data)
$accounts = [
    'shares' => [
        'amount' => '1,250,000.00',
        'monthly' => '5,000.00'
    ],
    'deposits' => [
        ['type' => 'ออมทรัพย์พิเศษ', 'acc_no' => '01-00234-9', 'balance' => '45,200.00'],
        ['type' => 'ออมทรัพย์', 'acc_no' => '01-01822-1', 'balance' => '12,500.50']
    ],
    'loans' => [
        ['type' => 'สามัญเพื่อการศึกษา', 'acc_no' => 'LN-650012', 'balance' => '320,000.00']
    ]
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>บัญชีของฉัน</title>
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
    background: var(--bg, #f3f4f6);
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

  .scroll{flex:1;overflow-y:auto;background:transparent;padding-bottom:100px;}
  .header-sticky {
    background: #ffffff;
  }
  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:var(--text);}
  
  .topbar { display:flex; align-items:center; justify-content:space-between; padding: 36px 20px 12px; background: transparent; }
  .topbar-center { text-align:center; flex:1; }
  .page-title { font-size: 18px; font-weight: 700; color: var(--navy-deep); }
  .page-subtitle { font-size: 11px; color: var(--text-muted); margin-top: 4px; font-weight: 500; }
  .placeholder, .topbar-right, .back-btn { width: 40px; display:flex; align-items:center; justify-content:center; }
  .back-btn {
    color: var(--navy-deep);
    cursor: pointer;
    transition: background 0.15s, transform 0.15s ease;
    border-radius: 50%;
    height: 40px;
    -webkit-tap-highlight-color: transparent;
  }
  .back-btn:hover { background: rgba(0,0,0,0.04); }
  .back-btn:active { transform: scale(0.92); }
  
  .acc-card {
    position: relative;
    background: #ffffff;
    border-radius: 18px;
    padding: 16px 20px;
    margin: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12), 0 0 1px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    gap: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
  }
  .acc-card:active {
    transform: scale(0.98);
    background: #f9fafb;
  }

  
  .card-header {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .acc-label {
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 500;
  }
  .acc-val {
    font-size: 15.5px;
    font-weight: 700;
    color: var(--text);
    margin-top: 4px;
  }
  
  .card-body {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    margin-top: 4px;
  }
  .bal-label {
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 500;
  }
  .bal-val {
    font-size: 22px;
    font-weight: 800;
    color: var(--navy-deep);
    margin-top: 4px;
  }
  .bal-val span {
    font-size: 12px;
    color: var(--text);
    font-weight: 600;
    margin-left: 4px;
  }
  
  .card-footer {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #F3F4F6;
    padding-top: 10px;
    margin-top: 4px;
  }
  .acc-link {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--blue);
    cursor: pointer;
    transition: opacity 0.15s;
  }
  .acc-link:hover {
    opacity: 0.8;
  }
  
  .btn-add-acc {
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px dashed var(--orange-deep);
    border-radius: 18px;
    padding: 16px;
    margin: 24px 16px;
    color: var(--orange-deep);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
  }
  .btn-add-acc:hover {
    background: rgba(245, 101, 43, 0.05);
  }
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
  .plus-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(245, 101, 43, 0.1);
    color: var(--orange-deep);
    margin-right: 8px;
  }

  .navbar{display:flex;justify-content:space-around;align-items:center;padding:14px 6px;background:#fff;border-top:1px solid #F0F0F0;position:absolute;bottom:0;left:0;right:0;z-index:50;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  /* Bottom Sheet */
  .overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 100;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }
  .overlay.active {
    opacity: 1;
    pointer-events: auto;
  }
  .bottom-sheet {
    position: absolute;
    bottom: -100%;
    left: 0;
    right: 0;
    background: #fff;
    border-radius: 24px 24px 0 0;
    padding: 24px 20px 40px;
    z-index: 101;
    transition: bottom 0.3s ease;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
  }
  .bottom-sheet.active {
    bottom: 0;
  }
  .sheet-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  .sheet-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--navy-deep);
  }
  .sheet-close {
    cursor: pointer;
    background: #F3F4F6;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
  }
  .sheet-menu {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .sheet-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #F9FAFB;
    border-radius: 16px;
    cursor: pointer;
    transition: background 0.2s;
  }
  .sheet-item:hover {
    background: #F3F4F6;
  }
  .sheet-item .icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(245, 101, 43, 0.1);
    color: var(--orange-deep);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .sheet-item .text {
    font-size: 14.5px;
    font-weight: 600;
    color: var(--text);
  }

  ::-webkit-scrollbar{width:0;}

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
      padding-top: 46px;
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

  @media (max-width: 400px), (max-height: 750px) {
    .topbar { padding: 20px 16px 12px; }
    .page-title { font-size: 16px; }
    .navbar { padding: 10px 4px; }
    .navitem span { font-size: 9.5px; }
    .acc-card { padding: 12px 16px; margin: 12px; }
    .bal-val { font-size: 18px; }
  }
</style>
</head>
<body>
<div class="app-container">
    <div class="scroll">
      <div class="header-sticky">
        <div class="status">
          <span id="status-time">9:41</span>
          <span>●●●● 5G ▮▮▮</span>
        </div>

        <div class="topbar">
          <div class="back-btn" onclick="window.location.href='index.php'">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </div>
          <div class="topbar-center">
            <div class="page-title">บัญชีของฉัน</div>
            <div class="page-subtitle" id="update-time">ข้อมูลล่าสุดเมื่อ 5 ต.ค. 2569, 15:45</div>
          </div>
          <div class="topbar-right" style="cursor:pointer;" onclick="openSheet()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--navy-deep)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/><circle cx="5" cy="12" r="1.5"/></svg>
          </div>
        </div>
      </div>

      <!-- ทุนเรือนหุ้น (Share Card) -->
      <div class="acc-card share" onclick="window.location.href='detail_accounts.php?type=share'">
        <div class="card-header">
          <span class="acc-label">ทุนเรือนหุ้นสะสม</span>
          <span class="acc-val">ส่งรายเดือน: ฿ <?= htmlspecialchars($accounts['shares']['monthly']) ?></span>
        </div>
        <div class="card-body">
          <span class="bal-label">ยอดเงินสะสม</span>
          <span class="bal-val"><?= htmlspecialchars($accounts['shares']['amount']) ?> <span>บาท</span></span>
        </div>
        <div class="card-footer">
          <span class="acc-link">ดูรายละเอียด</span>
        </div>
      </div>

      <!-- บัญชีเงินฝาก (Deposit Cards) -->
      <?php foreach($accounts['deposits'] as $dep): ?>
      <div class="acc-card deposit" onclick="window.location.href='detail_accounts.php?type=deposit&acc_no=<?= urlencode($dep['acc_no']) ?>'">
        <div class="card-header">
          <span class="acc-label">บัญชีฝากเงินออมทรัพย์ (<?= htmlspecialchars($dep['type']) ?>)</span>
          <span class="acc-val"><?= htmlspecialchars($dep['acc_no']) ?></span>
        </div>
        <div class="card-body">
          <span class="bal-label">ยอดเงินที่ใช้ได้</span>
          <span class="bal-val"><?= htmlspecialchars($dep['balance']) ?> <span>บาท</span></span>
        </div>
        <div class="card-footer">
          <span class="acc-link" onclick="event.stopPropagation(); go('โอนเงิน บัญชี <?= htmlspecialchars($dep['acc_no']) ?>')">โอนเงิน</span>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- บัญชีเงินกู้ (Loan Cards) -->
      <?php foreach($accounts['loans'] as $loan): ?>
      <div class="acc-card loan" onclick="window.location.href='detail_accounts.php?type=loan&acc_no=<?= urlencode($loan['acc_no']) ?>'">
        <div class="card-header">
          <span class="acc-label">เงินกู้สามัญ (<?= htmlspecialchars($loan['type']) ?>)</span>
          <span class="acc-val"><?= htmlspecialchars($loan['acc_no']) ?></span>
        </div>
        <div class="card-body">
          <span class="bal-label">ยอดหนี้คงค้าง</span>
          <span class="bal-val"><?= htmlspecialchars($loan['balance']) ?> <span>บาท</span></span>
        </div>
        <div class="card-footer">
          <span class="acc-link" onclick="event.stopPropagation(); go('ชำระเงินกู้ <?= htmlspecialchars($loan['acc_no']) ?>')">ชำระเงินกู้</span>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- ปุ่มเพิ่มบัญชี -->
      <div class="btn-add-acc" onclick="go('เพิ่มบัญชี')">
        <span class="plus-circle">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </span>
        เพิ่มบัญชี
      </div>

    </div>

    <?php include 'nav_footer.php'; ?>

    <!-- Bottom Sheet -->
    <div class="overlay" id="sheetOverlay" onclick="closeSheet()"></div>
    <div class="bottom-sheet" id="bottomSheet">
      <div class="sheet-header">
        <div class="sheet-title">จัดการบัญชี</div>
        <div class="sheet-close" onclick="closeSheet()">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </div>
      </div>
      <div class="sheet-menu">
        <div class="sheet-item" onclick="if(typeof go === 'function') go('เพิ่มบัญชี'); else alert('ไปหน้าเพิ่มบัญชี'); closeSheet();">
          <div class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </div>
          <div class="text">เพิ่มบัญชี</div>
        </div>
      </div>
    </div>
  </div>
<script>
  function openSheet() {
    document.getElementById('sheetOverlay').classList.add('active');
    document.getElementById('bottomSheet').classList.add('active');
  }
  function closeSheet() {
    document.getElementById('sheetOverlay').classList.remove('active');
    document.getElementById('bottomSheet').classList.remove('active');
  }

  function setActiveNav(el) {
    if(el.dataset.label) {
      // url redirect is handled by inline onclick in nav_footer.php
    }
  }

  // Real-time Clock and Last Updated Date/Time
  function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const statusTimeEl = document.getElementById('status-time');
    if (statusTimeEl) {
      statusTimeEl.textContent = `${hours}:${minutes}`;
    }
  }

  function setLastUpdatedTime() {
    const now = new Date();
    const thaiMonths = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
    const day = now.getDate();
    const month = thaiMonths[now.getMonth()];
    const year = now.getFullYear() + 543; // Buddhist Era
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    const subtitleEl = document.getElementById('update-time');
    if (subtitleEl) {
      subtitleEl.textContent = `ข้อมูลล่าสุดเมื่อ ${day} ${month} ${year}, ${hours}:${minutes}`;
    }
  }

  updateClock();
  setLastUpdatedTime();
  setInterval(updateClock, 10000); // Update clock every 10 seconds
</script>
</body>
</html>

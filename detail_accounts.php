<?php
include 'account_data.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>รายละเอียดบัญชี</title>
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
  body{
    background:#f3f4f6;
    font-family:'Noto Sans Thai',sans-serif;
    display:flex;align-items:flex-start;justify-content:center;
    padding:40px 16px;min-height:100vh;
  }
  .stage{display:flex;flex-direction:column;align-items:center;gap:18px;}
  .caption{color:#8a93a6;font-size:12px;letter-spacing:.08em;text-transform:uppercase;}

  .phone{
    width:390px;height:844px;
    background:#f4f5f8;
    border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .scroll{flex:1;overflow-y:auto;background:#f4f5f8;padding-bottom:80px;}
  .header-sticky{background:#ffffff;}
  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:var(--text);}
  
  .topbar { display:flex; align-items:center; justify-content:space-between; padding: 6px 20px 12px; background: transparent; }
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

  /* Account Card (Header card of this view) */
  .acc-card {
    position: relative;
    background: #ffffff;
    border-radius: 18px;
    padding: 16px 20px;
    margin: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    gap: 12px;
    overflow: hidden;
  }
  .acc-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 5px;
  }
  .acc-card.share::before { background: var(--orange); }
  .acc-card.deposit::before { background: #2FAE7B; }
  .acc-card.loan::before { background: var(--orange-deep); }
  
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

  /* Transaction list styling */
  .txn-section {
    padding: 10px 18px 24px;
  }
  .txn-sec-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }
  .txn-sec-title {
    font-size: 14.5px;
    font-weight: 800;
    color: var(--navy-deep);
  }
  .toggle-btn {
    font-size: 11.5px;
    color: var(--orange-deep);
    font-weight: 700;
    cursor: pointer;
    user-select: none;
  }
  .toggle-btn:hover {
    text-decoration: underline;
  }
  
  .txn-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  
  .txn-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 16px;
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #F1F5F9;
    cursor: pointer;
    transition: background 0.15s ease, transform 0.15s ease;
    -webkit-tap-highlight-color: transparent;
  }
  .txn-item:hover {
    background: #FAFCFF;
    border-color: #E2E8F0;
  }
  .txn-item:active {
    transform: scale(0.98);
    background: #F1F5F9;
  }
  .date-group-header {
    font-size: 11.5px;
    font-weight: 800;
    color: var(--text-muted);
    margin: 18px 0 8px 4px;
    letter-spacing: 0.5px;
  }
  
  .txn-left {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .txn-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .txn-icon.in {
    background: rgba(47, 174, 123, 0.1);
    color: #2FAE7B;
  }
  .txn-icon.out {
    background: rgba(245, 101, 43, 0.1);
    color: var(--orange-deep);
  }
  
  .txn-info {
    display: flex;
    flex-direction: column;
  }
  .txn-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
  }
  .txn-date {
    font-size: 10.5px;
    color: var(--text-muted);
    margin-top: 2px;
  }
  
  .txn-right {
    text-align: right;
  }
  .txn-amount {
    font-size: 14px;
    font-weight: 800;
  }
  .txn-amount.in {
    color: #2FAE7B;
  }
  .txn-amount.out {
    color: var(--text);
  }

  /* e-Slip Bottom Drawer Styles */
  .modal-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(19, 42, 68, 0.4);
    backdrop-filter: blur(4px);
    z-index: 100;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }
  .modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }
  .drawer {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: #ffffff;
    border-radius: 28px 28px 0 0;
    padding: 24px 20px 28px;
    z-index: 101;
    transform: translateY(100%);
    transition: transform 0.38s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 -10px 30px rgba(19,42,68,0.12);
  }
  .drawer.active {
    transform: translateY(0);
  }
  
  .drawer-handle {
    width: 36px;
    height: 5px;
    background: #E2E8F0;
    border-radius: 3px;
    margin: -10px auto 16px;
  }
  
  /* Slip Design Content */
  .slip-header {
    text-align: center;
    margin-bottom: 12px;
  }
  .success-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #2FAE7B;
    box-shadow: 0 4px 12px rgba(47, 174, 123, 0.3);
    margin-bottom: 8px;
  }
  .slip-status {
    font-size: 14px;
    font-weight: 800;
    color: #2FAE7B;
  }
  .slip-amt {
    font-size: 26px;
    font-weight: 800;
    color: var(--navy-deep);
    text-align: center;
    margin: 4px 0 16px;
  }
  
  /* Ticket Divider Notch effect */
  .slip-divider {
    border-top: 1.5px dashed #E2E8F0;
    margin: 16px 0;
    position: relative;
  }
  .slip-divider::before, .slip-divider::after {
    content: "";
    position: absolute;
    top: -9px;
    width: 18px;
    height: 18px;
    background: #ffffff;
    border-radius: 50%;
    box-shadow: inset 0 0 1px rgba(0,0,0,0.08);
  }
  .slip-divider::before { left: -29px; }
  .slip-divider::after { right: -29px; }
  
  .slip-details {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 0 4px;
  }
  .slip-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    font-size: 12.5px;
    line-height: 1.5;
  }
  .slip-label {
    color: var(--text-muted);
    font-weight: 500;
    flex-shrink: 0;
    width: 90px;
  }
  .slip-val {
    color: var(--text);
    font-weight: 700;
    text-align: right;
  }
  
  .btn-close-drawer {
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--navy-deep);
    color: #fff;
    font-size: 13.5px;
    font-weight: 700;
    padding: 12px;
    border-radius: 20px;
    margin-top: 24px;
    cursor: pointer;
    transition: opacity 0.15s, transform 0.15s;
    box-shadow: 0 6px 16px rgba(19,42,68,0.2);
    user-select: none;
    -webkit-tap-highlight-color: transparent;
  }
  .btn-close-drawer:hover { opacity: 0.95; }
  .btn-close-drawer:active { transform: scale(0.97); }

  .navbar{display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0;flex-shrink:0;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  ::-webkit-scrollbar{width:0;}

  /* Responsive layout for Mobile & iPad */
  @media (max-width: 1024px) {
    body {
      padding: 0;
      background: #f4f5f8;
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
</style>
</head>
<body>
<div class="stage">
  <div class="caption">สหกรณ์ออมทรัพย์ครูไทย — รายละเอียดบัญชี</div>

  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="header-sticky">
        <div class="status">
          <span id="status-time">9:41</span>
          <span>●●●● 5G ▮▮▮</span>
        </div>

        <div class="topbar">
          <div class="back-btn" onclick="window.location.href='accounts.php'">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </div>
          <div class="topbar-center">
            <div class="page-title">รายละเอียดบัญชี</div>
            <div class="page-subtitle" id="update-time">ข้อมูลล่าสุดเมื่อ ...</div>
          </div>
          <div class="topbar-right">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--navy-deep)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/><circle cx="5" cy="12" r="1.5"/></svg>
          </div>
        </div>
      </div>

      <!-- Account Summary Card -->
      <div class="acc-card <?= $account_class ?>">
        <div class="card-header">
          <span class="acc-label"><?= htmlspecialchars($account_title) ?></span>
          <span class="acc-val"><?= htmlspecialchars($account_subtitle) ?></span>
        </div>
        <div class="card-body">
          <span class="bal-label"><?= htmlspecialchars($account_balance_label) ?></span>
          <span class="bal-val"><?= htmlspecialchars($account_balance) ?> <span>บาท</span></span>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="txn-section">
        <div class="txn-sec-header">
          <span class="txn-sec-title">ประวัติรายการ</span>
          <span class="toggle-btn" id="txn-toggle" onclick="window.location.href='all_transactions.php?type=<?= urlencode($type) ?>&acc_no=<?= urlencode($acc_no) ?>'">ดูทั้งหมด</span>
        </div>
        
        <div class="txn-list">
          <?php 
          $display_txns = array_slice($transactions, 0, 5);
          $lastDate = '';
          foreach ($display_txns as $index => $txn): 
              $isOut = $txn['type'] === 'out';
              $iconClass = $isOut ? 'out' : 'in';
              $amountClass = $isOut ? 'out' : 'in';
              
              // Formatting dates for displaying in list: e.g. "18 ส.ค. 69, 14:30"
              $dateTimeObj = DateTime::createFromFormat('Y-m-d H:i:s', $txn['date']);
              $yearThai = (int)$dateTimeObj->format('Y') + 543;
              
              $thaiMonthsFull = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
              $monthIdx = (int)$dateTimeObj->format('n');
              
              $groupDateStr = $dateTimeObj->format('j') . ' ' . $thaiMonthsFull[$monthIdx] . ' ' . $yearThai;
              $timeStr = $dateTimeObj->format('H:i') . ' น.';

              if ($groupDateStr !== $lastDate) {
                  echo '<div class="date-group-header">' . htmlspecialchars($groupDateStr) . '</div>';
                  $lastDate = $groupDateStr;
              }
          ?>
          <div class="txn-item" 
               onclick='showSlip(<?= json_encode($txn) ?>)'>
            <div class="txn-left">
              <div class="txn-icon <?= $iconClass ?>">
                <?php if ($isOut): ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
                <?php else: ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
                <?php endif; ?>
              </div>
              <div class="txn-info">
                <span class="txn-title"><?= htmlspecialchars($txn['title']) ?></span>
                <span class="txn-date"><?= htmlspecialchars($timeStr) ?></span>
              </div>
            </div>
            <div class="txn-right">
              <span class="txn-amount <?= $amountClass ?>">
                <?= ($isOut ? '-' : '+') . htmlspecialchars(str_replace(['+', '-'], '', $txn['amount'])) ?>
              </span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- e-Slip Bottom Drawer Modal -->
    <div class="modal-overlay" id="modal-overlay" onclick="closeSlip()">
      <div class="drawer" id="drawer" onclick="event.stopPropagation()">
        <div class="drawer-handle"></div>
        <div class="slip-header">
          <div class="success-badge">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="slip-status">ทำรายการสำเร็จ</div>
        </div>
        
        <div class="slip-amt" id="slip-amount">0.00 บาท</div>
        
        <div class="slip-divider"></div>
        
        <div class="slip-details">
          <div class="slip-row">
            <span class="slip-label">ประเภทรายการ</span>
            <span class="slip-val" id="slip-type">-</span>
          </div>
          <div class="slip-row">
            <span class="slip-label">บัญชีต้นทาง</span>
            <span class="slip-val" id="slip-from">-</span>
          </div>
          <div class="slip-row">
            <span class="slip-label">โอนไปยัง</span>
            <span class="slip-val" id="slip-to">-</span>
          </div>
          <div class="slip-row" id="row-principal" style="display:none;">
            <span class="slip-label">ชำระเงินต้น</span>
            <span class="slip-val" id="slip-principal">-</span>
          </div>
          <div class="slip-row" id="row-interest" style="display:none;">
            <span class="slip-label">ชำระดอกเบี้ย</span>
            <span class="slip-val" id="slip-interest">-</span>
          </div>
          <div class="slip-row">
            <span class="slip-label">เลขที่อ้างอิง</span>
            <span class="slip-val" id="slip-ref" style="font-family:monospace; font-size:11.5px;">-</span>
          </div>
          <div class="slip-row">
            <span class="slip-label">วัน เวลา</span>
            <span class="slip-val" id="slip-date" style="font-size:11.5px;">-</span>
          </div>
        </div>
        
        <div class="btn-close-drawer" onclick="closeSlip()">ปิดหน้าต่างนี้</div>
      </div>
    </div>

    <?php include 'nav_footer.php'; ?>
  </div>
</div>
<script>
  // Transactions toggle removed (redirects to all_transactions.php instead)

  // Open Slip drawer
  function showSlip(txn) {
    const overlay = document.getElementById('modal-overlay');
    const drawer = document.getElementById('drawer');
    
    // Set values
    document.getElementById('slip-amount').textContent = txn.amount.replace('+', '') + ' บาท';
    document.getElementById('slip-type').textContent = txn.detail.type_label;
    document.getElementById('slip-from').textContent = txn.detail.from;
    document.getElementById('slip-to').textContent = txn.detail.to;
    document.getElementById('slip-ref').textContent = txn.id;
    document.getElementById('slip-date').textContent = txn.detail.thai_date;
    
    // Check if loan payment specific fields exist
    const rowPrincipal = document.getElementById('row-principal');
    const rowInterest = document.getElementById('row-interest');
    
    if (txn.detail.principal && txn.detail.interest) {
      document.getElementById('slip-principal').textContent = '฿ ' + txn.detail.principal;
      document.getElementById('slip-interest').textContent = '฿ ' + txn.detail.interest;
      rowPrincipal.style.display = 'flex';
      rowInterest.style.display = 'flex';
    } else {
      rowPrincipal.style.display = 'none';
      rowInterest.style.display = 'none';
    }
    
    // Open animatedly
    overlay.classList.add('active');
    setTimeout(() => {
      drawer.classList.add('active');
    }, 10);
  }

  // Close Slip drawer
  function closeSlip() {
    const overlay = document.getElementById('modal-overlay');
    const drawer = document.getElementById('drawer');
    
    drawer.classList.remove('active');
    setTimeout(() => {
      overlay.classList.remove('active');
    }, 300);
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

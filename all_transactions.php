<?php
include 'account_data.php';

// Prepare transactions with pre-formatted Thai date for JSON
$jsTransactions = [];
foreach ($transactions as $txn) {
    $dateTimeObj = DateTime::createFromFormat('Y-m-d H:i:s', $txn['date']);
    $yearThai = (int)$dateTimeObj->format('Y') + 543;
    $shortYear = substr((string)$yearThai, 2);
    $thaiMonthsShort = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
    $monthIdx = (int)$dateTimeObj->format('n');
    $listDateStr = $dateTimeObj->format('j') . ' ' . $thaiMonthsShort[$monthIdx] . ' ' . $shortYear . ', ' . $dateTimeObj->format('H:i');
    
    $txn['formatted_date'] = $listDateStr;
    $jsTransactions[] = $txn;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ประวัติรายการ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

  /* Month Tabs styling */
  .month-selector-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 16px;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    gap: 8px;
  }
  .arrow-btn {
    background: #F3F4F6;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--navy-deep);
    transition: all 0.2s ease;
    flex-shrink: 0;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
  }
  .arrow-btn:hover {
    background: #E5E7EB;
  }
  .arrow-btn:active {
    transform: scale(0.9);
  }
  .arrow-btn.disabled {
    opacity: 0.25;
    pointer-events: none;
  }
  .month-tabs {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 6px;
    flex: 1;
  }
  .month-tab {
    text-align: center;
    padding: 6px 0;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    color: var(--text-muted);
    background: #F3F4F6;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
  }
  .month-tab:active {
    transform: scale(0.95);
  }
  .month-tab.active {
    color: #ffffff;
    background: var(--orange-deep);
    box-shadow: 0 3px 8px rgba(245, 101, 43, 0.2);
  }

  /* Transaction list styling */
  .txn-section {
    padding: 16px 18px 24px;
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

  /* Empty state styling */
  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 20px;
    text-align: center;
  }
  .empty-icon {
    width: 48px;
    height: 48px;
    color: #CBD5E1;
    margin-bottom: 12px;
  }
  .empty-text {
    font-size: 13.5px;
    color: var(--text-muted);
    font-weight: 500;
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
  <div class="caption">สหกรณ์ออมทรัพย์ครูไทย — ประวัติรายการ</div>

  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="header-sticky">
        <div class="status">
          <span id="status-time">9:41</span>
          <span>●●●● 5G ▮▮▮</span>
        </div>

        <div class="topbar">
          <div class="back-btn" onclick="window.location.href='detail_accounts.php?type=<?= urlencode($type) ?>&acc_no=<?= urlencode($acc_no) ?>'">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </div>
          <div class="topbar-center">
            <div class="page-title">ประวัติรายการ</div>
            <div class="page-subtitle"><?= htmlspecialchars($account_title) ?> (<?= htmlspecialchars($acc_no ?: 'หุ้นสะสม') ?>)</div>
          </div>
          <div class="topbar-right">
            <!-- empty for balance -->
          </div>
        </div>
      </div>

      <!-- Month Tabs Paginated Row with Left/Right Arrows -->
      <div class="month-selector-wrapper">
        <button class="arrow-btn" id="prev-btn" onclick="prevPage()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="month-tabs" id="month-tabs-container">
          <!-- JS will populate these tabs -->
        </div>
        <button class="arrow-btn" id="next-btn" onclick="nextPage()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>

      <!-- Transactions Section -->
      <div class="txn-section">
        <div class="txn-list" id="txn-list-container">
          <!-- JS will populate filtered items here -->
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
  // All transactions mock data from PHP
  const allTransactions = <?= json_encode($jsTransactions) ?>;
  const thaiMonthsShort = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
  
  // Set default active month: we find the latest month that has transactions, or default to current calendar month (August = index 8, which is 1-based index)
  let activeMonth = 8; // August default since latest mocks are in August
  let currentViewPage = 1; // 0 for Jan-Jun, 1 for Jul-Dec. August is in Page 1 (0-indexed page 1)

  // Render Month Tabs
  function renderMonthTabs() {
    const container = document.getElementById('month-tabs-container');
    container.innerHTML = '';
    
    const startMonth = currentViewPage === 0 ? 1 : 7;
    const endMonth = currentViewPage === 0 ? 6 : 12;

    // Generate 6 tabs based on active view page
    for (let m = startMonth; m <= endMonth; m++) {
      const tab = document.createElement('div');
      tab.className = `month-tab ${m === activeMonth ? 'active' : ''}`;
      tab.textContent = thaiMonthsShort[m - 1];
      tab.onclick = () => selectMonth(m);
      container.appendChild(tab);
    }

    // Toggle arrow button disabled state
    document.getElementById('prev-btn').classList.toggle('disabled', currentViewPage === 0);
    document.getElementById('next-btn').classList.toggle('disabled', currentViewPage === 1);
  }

  // Handle pagination pages
  function prevPage() {
    if (currentViewPage === 0) return;
    currentViewPage = 0;
    renderMonthTabs();
    if (activeMonth < 1 || activeMonth > 6) {
      selectMonth(6); // Default to June when switching to Jan-Jun view
    } else {
      selectMonth(activeMonth);
    }
  }

  function nextPage() {
    if (currentViewPage === 1) return;
    currentViewPage = 1;
    renderMonthTabs();
    if (activeMonth < 7 || activeMonth > 12) {
      selectMonth(7); // Default to July when switching to Jul-Dec view
    } else {
      selectMonth(activeMonth);
    }
  }

  // Handle Month Selection
  function selectMonth(m) {
    activeMonth = m;
    
    // Update active tab class
    const tabs = document.querySelectorAll('.month-tab');
    const startMonth = currentViewPage === 0 ? 1 : 7;
    tabs.forEach((tab, index) => {
      const mIdx = startMonth + index;
      if (mIdx === m) {
        tab.classList.add('active');
      } else {
        tab.classList.remove('active');
      }
    });

    // Re-filter list
    filterTransactions();
  }

  // Helper function to format full Thai date for group headers
  function getThaiFullDate(dateStr) {
    const datePart = dateStr.split(' ')[0];
    const parts = datePart.split('-');
    const year = parseInt(parts[0], 10) + 543;
    const month = parseInt(parts[1], 10);
    const day = parseInt(parts[2], 10);
    const thaiMonthsFull = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    return day + " " + thaiMonthsFull[month - 1] + " " + year;
  }

  // Filter transactions and render list
  function filterTransactions() {
    const listContainer = document.getElementById('txn-list-container');
    listContainer.innerHTML = '';

    // Filter by selected month (from date field "YYYY-MM-DD HH:MM:SS")
    const filtered = allTransactions.filter(txn => {
      const dateParts = txn.date.split('-');
      if (dateParts.length < 2) return false;
      const monthVal = parseInt(dateParts[1], 10);
      return monthVal === activeMonth;
    });

    if (filtered.length === 0) {
      // Empty state
      listContainer.innerHTML = `
        <div class="empty-state">
          <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
            <path d="M8 14h.01"/>
            <path d="M12 14h.01"/>
            <path d="M16 14h.01"/>
            <path d="M8 18h.01"/>
            <path d="M12 18h.01"/>
            <path d="M16 18h.01"/>
          </svg>
          <div class="empty-text">ไม่มีรายการธุรกรรมในเดือนนี้</div>
        </div>
      `;
      return;
    }

    // Render list grouped by date
    let lastDate = '';
    filtered.forEach(txn => {
      const groupDateStr = getThaiFullDate(txn.date);
      const timeStr = txn.date.split(' ')[1].substring(0, 5) + ' น.';

      if (groupDateStr !== lastDate) {
        const header = document.createElement('div');
        header.className = 'date-group-header';
        header.textContent = groupDateStr;
        listContainer.appendChild(header);
        lastDate = groupDateStr;
      }

      const isOut = txn.type === 'out';
      const iconClass = isOut ? 'out' : 'in';
      const amountClass = isOut ? 'out' : 'in';
      const amountSign = isOut ? '-' : '+';
      const cleanAmount = txn.amount.replace('+', '').replace('-', '');

      // SVG Icon
      const iconSvg = isOut 
        ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>`
        : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>`;

      const item = document.createElement('div');
      item.className = 'txn-item';
      item.onclick = () => showSlipById(txn.id);
      item.innerHTML = `
        <div class="txn-left">
          <div class="txn-icon ${iconClass}">
            ${iconSvg}
          </div>
          <div class="txn-info">
            <span class="txn-title">${escapeHtml(txn.title)}</span>
            <span class="txn-date">${timeStr}</span>
          </div>
        </div>
        <div class="txn-right">
          <span class="txn-amount ${amountClass}">
            ${amountSign}${escapeHtml(cleanAmount)}
          </span>
        </div>
      `;
      listContainer.appendChild(item);
    });
  }

  // Open Slip by ID
  function showSlipById(id) {
    const txn = allTransactions.find(t => t.id === id);
    if (!txn) return;
    
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

  // Helper function to escape HTML to prevent XSS
  function escapeHtml(str) {
    if (!str) return '';
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Real-time Clock
  function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const statusTimeEl = document.getElementById('status-time');
    if (statusTimeEl) {
      statusTimeEl.textContent = `${hours}:${minutes}`;
    }
  }

  // Initial loads
  updateClock();
  setInterval(updateClock, 10000);
  
  // Render tabs & initial filtered items
  renderMonthTabs();
  filterTransactions();
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>การแจ้งเตือน</title>
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
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
  }
  @media (min-width: 481px) {
    .app-container {
      margin: 20px auto;
      min-height: calc(100vh - 40px);
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
  .topbar { display:flex; align-items:center; justify-content:space-between; padding: 16px 20px 0; }
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
  
  .noti-list {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .noti-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 16px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    cursor: pointer;
    transition: transform 0.15s;
    position: relative;
    overflow: hidden;
  }
  .noti-card:active {
    transform: scale(0.98);
    background: #fafafa;
  }
  .noti-card.unread::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--orange-deep);
  }
  .noti-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #FEEBC8;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: var(--orange-deep);
  }
  .noti-icon.info {
    background: #EBF4FF;
    color: var(--blue);
  }
  .noti-icon.success {
    background: #E6FFFA;
    color: #319795;
  }
  .noti-content {
    flex: 1;
  }
  .noti-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--navy-deep);
    margin-bottom: 4px;
  }
  .noti-desc {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.4;
    margin-bottom: 8px;
  }
  .noti-time {
    font-size: 10px;
    color: #A0AEC0;
    font-weight: 600;
  }
  
  .navbar{display:flex;justify-content:space-around;align-items:center;padding:14px 6px;background:#fff;border-top:1px solid #F0F0F0;position:absolute;bottom:0;left:0;right:0;z-index:50;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}
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
        <div class="page-title">การแจ้งเตือน</div>
      </div>
      <div class="placeholder"></div>
    </div>
  </div>
  
  <div class="scroll">
    <div class="noti-list">
      <!-- Item 1 (Unread) -->
      <div class="noti-card unread">
        <div class="noti-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="noti-content">
          <div class="noti-title">ประกาศอัตราดอกเบี้ยเงินฝากใหม่</div>
          <div class="noti-desc">สหกรณ์ออมทรัพย์ครูไทย ปรับขึ้นอัตราดอกเบี้ยเงินฝากออมทรัพย์พิเศษ มีผลตั้งแต่ 1 กันยายน 2569 เป็นต้นไป</div>
          <div class="noti-time">วันนี้ 10:30 น.</div>
        </div>
      </div>
      
      <!-- Item 2 -->
      <div class="noti-card">
        <div class="noti-icon success">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div class="noti-content">
          <div class="noti-title">โอนเงินสำเร็จ</div>
          <div class="noti-desc">คุณได้ทำรายการโอนเงิน 5,000.00 บาท ไปยังบัญชี 01-01822-1 สำเร็จแล้ว</div>
          <div class="noti-time">เมื่อวาน 15:45 น.</div>
        </div>
      </div>
      
      <!-- Item 3 -->
      <div class="noti-card">
        <div class="noti-icon info">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <div class="noti-content">
          <div class="noti-title">ใบเสร็จรับเงินประจำเดือน</div>
          <div class="noti-desc">ใบเสร็จรับเงินประจำเดือนสิงหาคม 2569 ของคุณพร้อมให้ดาวน์โหลดแล้ว</div>
          <div class="noti-time">15 ส.ค. 2569</div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include 'nav_footer.php'; ?>
</div>
</body>
</html>

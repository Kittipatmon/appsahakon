<?php
// settings.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg-color: #F8F9FB;
    --text-main: #1C1C1C;
    --text-muted: #6B7280;
    --border-color: #F3F4F6;
    --green: #408866;
    --icon-bg: #F0F4F2;
    --icon-color: #408866;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    background:#f3f4f6;
    font-family:'Inter',sans-serif;
    display:flex;align-items:flex-start;justify-content:center;
    padding:40px 16px;min-height:100vh;
  }
  .stage{display:flex;flex-direction:column;align-items:center;gap:18px;}
  
  .phone{
    width:390px;height:844px;
    background:var(--bg-color);
    border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:14px;font-weight:600;color:#000;}

  .topbar{display:flex;align-items:center;justify-content:space-between;padding:12px 24px 20px;}
  .back-btn{cursor:pointer;display:flex;align-items:center;justify-content:center;}
  .topbar-title{font-size:18px;font-weight:600;color:var(--text-main);}
  .placeholder{width:24px;}

  .scroll{flex:1;overflow-y:auto;padding:0 20px 100px;}
  .scroll::-webkit-scrollbar{width:0;}

  .section{margin-bottom:24px;}
  .section-title{font-size:14px;font-weight:600;color:var(--text-muted);margin-bottom:12px;padding-left:4px;}

  .list-group{background:#fff;border-radius:24px;overflow:hidden;}
  .list-item{display:flex;align-items:center;padding:16px;cursor:pointer;transition:background .2s;}
  .list-item:hover{background:#F9FAFB;}
  .list-item:active{background:#F3F4F6;}
  .list-divider{height:1px;background:var(--border-color);margin:0 16px;}
  
  .item-icon{width:36px;height:36px;border-radius:12px;background:var(--icon-bg);display:flex;align-items:center;justify-content:center;margin-right:16px;flex-shrink:0;}
  .item-icon svg{stroke:var(--icon-color);fill:none;stroke-width:1.8;width:18px;height:18px;stroke-linecap:round;stroke-linejoin:round;}
  
  .item-label{flex:1;font-size:15px;font-weight:500;color:var(--text-main);}
  
  .item-right{color:#A0AEC0;display:flex;align-items:center;}
  
  /* Toggle Switch */
  .toggle{width:46px;height:26px;background:var(--green);border-radius:14px;position:relative;cursor:pointer;}
  .toggle::after{content:"";position:absolute;top:2px;right:2px;width:22px;height:22px;background:#fff;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,.15);transition:transform .2s;}

  /* Bottom Nav */
  .navbar{position:absolute;bottom:0;left:0;right:0;display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:#F5652B;}
  .navitem span{font-size:10.5px;font-weight:600;}
  
  /* Home indicator */
  .home-indicator{position:absolute;bottom:8px;left:50%;transform:translateX(-50%);width:130px;height:5px;background:#000;border-radius:10px;}

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
    <div class="status">
      <span>9:41</span>
      <span>●●●● 5G ▮▮</span>
    </div>
    
    <div class="topbar">
      <div class="back-btn" onclick="history.back()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1C1C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </div>
      <div class="topbar-title">Settings</div>
      <div class="placeholder"></div>
    </div>
    
    <div class="scroll">
      <div class="section">
        <div class="section-title">General</div>
        <div class="list-group">
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></div>
            <div class="item-label">Notifications</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg></div>
            <div class="item-label">Appearance</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg></div>
            <div class="item-label">Language</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
        </div>
      </div>
      
      <div class="section">
        <div class="section-title">Security</div>
        <div class="list-group">
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M3 7V5a2 2 0 0 1 2-2h2M17 3h2a2 2 0 0 1 2 2v2M21 17v2a2 2 0 0 1-2 2h-2M7 21H5a2 2 0 0 1-2-2v-2"/><circle cx="12" cy="12" r="3"/><path d="M9 9l-1-1M15 9l1-1"/></svg></div>
            <div class="item-label">Face ID</div>
            <div class="item-right">
              <div class="toggle"></div>
            </div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
            <div class="item-label">Linked Devices</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
            <div class="item-label">Passcode</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
            <div class="item-label">Transaction Confirmation</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-10 10c0 5.523 4.477 10 10 10a10 10 0 0 0 10-10c0-5.523-4.477-10-10-10z"/><path d="M12 6a6 6 0 0 0-6 6c0 3.314 2.686 6 6 6a6 6 0 0 0 6-6c0-3.314-2.686-6-6-6z"/><path d="M12 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg></div>
            <div class="item-label">Biometrics</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
          <div class="list-divider"></div>
          <div class="list-item">
            <div class="item-icon"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg></div>
            <div class="item-label">Faster Payments System</div>
            <div class="item-right"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></div>
          </div>
        </div>
      </div>
    </div>
    
    <?php include 'nav_footer.php'; ?>
    
    <div class="home-indicator"></div>
  </div>
</div>
</body>
</html>

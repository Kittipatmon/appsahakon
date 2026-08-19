<?php
// Mockup login page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ไม่มีการเชื่อมต่อฐานข้อมูล กรอกรหัสผ่านอะไรก็ผ่าน
    // ให้เปลี่ยนหน้าไปยัง accounts.php
    header("Location: accounts.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เข้าสู่ระบบ - สหกรณ์ออมทรัพย์ครูไทย</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --orange-deep: #F5652B;
    --orange: #FA8A46;
    --navy-deep: #132A44;
    --text: #333333;
    --bg: #F4F6F9;
  }
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
    overflow-y: auto;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
  }
  .header {
    background: linear-gradient(180deg, var(--orange-deep) 0%, #FFB37A 100%);
    padding: 60px 24px 40px;
    text-align: center;
    color: #fff;
    border-radius: 0 0 32px 32px;
  }
  .logo {
    width: 80px;
    height: 80px;
    background: #fff;
    border-radius: 50%;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  }
  .header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
  }
  .header p {
    margin: 8px 0 0;
    font-size: 14px;
    opacity: 0.9;
  }
  .pin-container {
    padding: 30px 24px 40px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .pin-dots {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
  }
  .pin-dots .dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #CBD5E1;
    transition: all 0.2s ease;
  }
  .pin-dots .dot.active {
    background-color: var(--navy-deep);
    border-color: var(--navy-deep);
  }
  .keypad {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px 30px;
    width: 100%;
    max-width: 280px;
    margin: 0 auto;
  }
  .keypad .key {
    background: transparent;
    border: none;
    font-size: 28px;
    font-weight: 500;
    color: var(--navy-deep);
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-family: inherit;
    transition: background 0.15s;
    margin: 0 auto;
  }
  .keypad .key:active {
    background: #E2E8F0;
  }
  .keypad .key.empty {
    pointer-events: none;
  }
  .keypad .key.delete {
    font-size: 32px;
    color: #64748B;
  }
  .back-link {
    display: block;
    text-align: center;
    margin-top: 40px;
    color: #64748B;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
  }
  .loading-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.9);
    z-index: 100;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    border-radius: 0 0 34px 34px; /* match notch bottom if needed, actually app-container doesn't have border-radius but phone does */
  }
  .loading-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }
  .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #E2E8F0;
    border-top: 4px solid var(--orange);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 16px;
  }
  .loading-overlay p {
    color: var(--navy-deep);
    font-weight: 600;
    font-size: 14px;
    margin: 0;
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
</head>
<body>
<div class="app-container">
  <div class="header">
        <div class="logo">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--orange-deep)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h1>เข้าสู่ระบบ</h1>
        <p>กรุณาใส่รหัส PIN 6 หลัก</p>
      </div>
      
      <div class="pin-container">
        <div class="pin-dots" id="pinDots">
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
        </div>
        
        <div class="keypad">
          <button class="key" onclick="addPin(1)">1</button>
          <button class="key" onclick="addPin(2)">2</button>
          <button class="key" onclick="addPin(3)">3</button>
          <button class="key" onclick="addPin(4)">4</button>
          <button class="key" onclick="addPin(5)">5</button>
          <button class="key" onclick="addPin(6)">6</button>
          <button class="key" onclick="addPin(7)">7</button>
          <button class="key" onclick="addPin(8)">8</button>
          <button class="key" onclick="addPin(9)">9</button>
          <button class="key empty"></button>
          <button class="key" onclick="addPin(0)">0</button>
          <button class="key delete" onclick="delPin()">&#9003;</button>
        </div>
        
        <a href="index.php" class="back-link">ยกเลิก</a>
      </div>
      
      <form id="loginForm" method="POST" style="display:none;">
        <input type="hidden" name="pin" id="pinInput">
      </form>
      
      <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <p>กำลังตรวจสอบข้อมูล...</p>
      </div>
    </div>
</div>

<script>
  let pin = "";
  const dots = document.querySelectorAll('.pin-dots .dot');
  
  function updateDots() {
    dots.forEach((dot, index) => {
      if (index < pin.length) {
        dot.classList.add('active');
      } else {
        dot.classList.remove('active');
      }
    });
    
    if (pin.length === 6) {
      document.getElementById('pinInput').value = pin;
      document.getElementById('loadingOverlay').classList.add('active');
      
      // เพิ่ม delay จำลองการตรวจสอบข้อมูล 1.2 วินาที ก่อนเข้าหน้าบัญชี
      setTimeout(() => {
        document.getElementById('loginForm').submit();
      }, 1200);
    }
  }
  
  function addPin(num) {
    if (pin.length < 6) {
      pin += num.toString();
      updateDots();
    }
  }
  
  function delPin() {
    if (pin.length > 0) {
      pin = pin.slice(0, -1);
      updateDots();
    }
  }
</script>
</body>
</html>

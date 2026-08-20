<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ข้อมูลส่วนตัว</title>
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
    background: var(--bg);
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

  .profile-header {
    background: #fff;
    padding: 24px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0 0 24px 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    position: relative;
  }
  .avatar-lg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--orange-deep);
    color: #fff;
    font-size: 32px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    box-shadow: 0 8px 16px rgba(245, 101, 43, 0.2);
    position: relative;
    cursor: pointer;
    background-size: cover;
    background-position: center;
  }
  .camera-badge {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 28px;
    height: 28px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--navy-deep);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  }
  .action-buttons {
    margin: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .btn-primary {
    background: linear-gradient(135deg, var(--orange) 0%, var(--orange-deep) 100%);
    color: #fff;
    border: none;
    padding: 16px;
    border-radius: 16px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(245, 101, 43, 0.3);
    transition: transform 0.15s;
    font-family: inherit;
  }
  .btn-primary:active {
    transform: scale(0.98);
  }
  .btn-secondary {
    background: #fff;
    color: var(--navy-deep);
    border: 1px solid #E5E7EB;
    padding: 16px;
    border-radius: 16px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.15s;
    font-family: inherit;
  }
  .btn-secondary:active {
    background: #F3F4F6;
  }
  .profile-name {
    font-size: 20px;
    font-weight: 700;
    color: var(--navy-deep);
  }
  .profile-id {
    font-size: 14px;
    color: var(--text-muted);
    margin-top: 4px;
    font-weight: 500;
  }

  .info-section {
    background: #fff;
    margin: 16px;
    border-radius: 16px;
    padding: 8px 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
  }
  .info-row {
    padding: 16px 0;
    border-bottom: 1px solid #F3F4F6;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .info-row:last-child {
    border-bottom: none;
  }
  .info-label {
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 500;
  }
  .info-value {
    font-size: 14.5px;
    color: var(--text);
    font-weight: 600;
    text-align: right;
  }

  .navbar{display:flex;justify-content:space-around;align-items:center;padding:14px 6px;background:#fff;border-top:1px solid #F0F0F0;position:absolute;bottom:0;left:0;right:0;z-index:50;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;-webkit-tap-highlight-color:transparent;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  @media (max-width: 400px), (max-height: 750px) {
    .topbar { padding: 20px 16px 0; }
    .page-title { font-size: 16px; }
    .navbar { padding: 10px 4px; }
    .navitem span { font-size: 9.5px; }
    .menu-list { padding: 16px; gap: 12px; }
    .profile-card { padding: 16px; margin: 12px 16px; }
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
        <div class="page-title">ข้อมูลส่วนตัว</div>
      </div>
      <div class="placeholder"></div>
    </div>
  </div>
  
  <div class="scroll">
    <div class="profile-header">

      <div class="avatar-lg" onclick="document.getElementById('avatarUpload').click()" id="avatarPreview">
        <span id="avatarInitials">วภ</span>
        <div class="camera-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </div>
      </div>
      <input type="file" id="avatarUpload" accept="image/*" style="display:none;" onchange="previewAvatar(event)">
      <div class="profile-name">ครูวิภา ใจงาม</div>
      <div class="profile-id">เลขสมาชิก 00184627</div>
    </div>

    <div class="info-section">
      <div class="info-row">
        <div class="info-label">ชื่อ-นามสกุล</div>
        <div class="info-value">นางสาว วิภา ใจงาม</div>
      </div>
      <div class="info-row">
        <div class="info-label">เลขประจำตัวประชาชน</div>
        <div class="info-value">1-1234-56789-01-2</div>
      </div>
      <div class="info-row">
        <div class="info-label">วันเกิด</div>
        <div class="info-value">12 ตุลาคม 2528</div>
      </div>
    </div>

    <div class="info-section">
      <div class="info-row">
        <div class="info-label">เบอร์โทรศัพท์</div>
        <div class="info-value">089-123-4567</div>
      </div>
      <div class="info-row">
        <div class="info-label">อีเมล</div>
        <div class="info-value">wipa.ja@email.com</div>
      </div>
      <div class="info-row">
        <div class="info-label">ที่อยู่จัดส่งเอกสาร</div>
        <div class="info-value">123 ม.4 ต.เมือง<br>อ.เมือง จ.ขอนแก่น 40000</div>
      </div>
    </div>

    <div class="action-buttons">
      <button class="btn-primary" onclick="alert('ไปหน้าแก้ไขข้อมูลส่วนตัว')">แก้ไขข้อมูลส่วนตัว</button>
      <button class="btn-secondary" onclick="alert('ไปหน้าเปลี่ยนรหัสผ่าน')">เปลี่ยนรหัสผ่าน</button>
    </div>
  </div>

  <?php include 'nav_footer.php'; ?>
</div>

<script>
  function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('avatarPreview');
        preview.style.backgroundImage = `url('${e.target.result}')`;
        document.getElementById('avatarInitials').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  }
</script>
</body>
</html>

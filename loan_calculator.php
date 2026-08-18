<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>คำนวณเงินกู้</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
<style>
  :root{
    --navy-deep:#132A44;
    --orange-deep:#F5652B;
    --orange:#FA8A46;
    --text:#334155;
    --border:#CBD5E1;
    --bg-addon:#E2E8F0;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    background:#0e1420; font-family:'Noto Sans Thai',sans-serif;
    display:flex;align-items:flex-start;justify-content:center;
    padding:40px 16px;min-height:100vh;
  }
  .stage{display:flex;flex-direction:column;align-items:center;gap:18px;}
  .caption{color:#8a93a6;font-size:12px;letter-spacing:.08em;text-transform:uppercase;}

  .phone{
    width:390px;height:844px;
    background:#fff; border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .scroll{flex:1;overflow-y:auto;background:#F6F8FA; padding-bottom: 30px;}
  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:var(--text);}
  
  .topbar { display:flex; align-items:center; justify-content: space-between; padding: 16px 20px 12px; background: #F6F8FA; position: sticky; top:0; z-index: 10; }
  .back-btn { background:none; border:none; color:var(--navy-deep); cursor:pointer; display:flex; align-items:center; width: 24px; padding: 0; }
  .page-title { font-size: 16.5px; font-weight: 600; color: var(--navy-deep); text-align: center; }
  .placeholder { width: 24px; }

  .form-container { margin: 16px; background: #fff; border-radius: 22px; box-shadow: 0 8px 24px -8px rgba(0,0,0,0.04); padding: 24px 16px; }
  
  .form-row { display: flex; align-items: center; margin-bottom: 18px; gap: 10px; }
  .form-label { flex: 0 0 115px; font-size: 13.5px; font-weight: 500; color: #475569; text-align: left; }
  .form-input-group { flex: 1; display: flex; }
  
  .form-control { 
    width: 100%; border: 1px solid var(--border); border-radius: 6px; padding: 8px 10px; font-size: 13.5px; color: #1E293B; font-family: inherit; 
    outline: none; transition: border-color 0.2s; background: #fff; appearance: none;
  }
  .form-control:focus { border-color: var(--orange); box-shadow: 0 0 0 2px rgba(250,138,70,0.2); }
  select.form-control { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; padding-right: 28px; }
  
  .input-group { display: flex; width: 100%; border: 1px solid var(--border); border-radius: 6px; overflow: hidden; }
  .input-group .form-control { border: none; border-radius: 0; flex: 1; text-align: center; }
  .input-addon { background: var(--bg-addon); padding: 8px 12px; font-size: 13.5px; color: #64748B; font-weight: 500; border-left: 1px solid var(--border); display: flex; align-items: center; justify-content: center; }

  .flex-row { display: flex; gap: 8px; width: 100%; }
  .flex-row .form-control { flex: 1; min-width: 0; } /* min-width 0 allows flex shrink */
  .flex-row .input-group { flex: 1; min-width: 0; }
  
  .btn-submit { 
    display: block; margin: 32px auto 0; background: linear-gradient(180deg, #FA7A37 0%, #F5581D 100%); color: #fff; border: none; border-radius: 30px; padding: 12px 48px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: inherit; box-shadow: 0 12px 24px -6px rgba(245, 88, 29, 0.5);
  }
  .btn-submit:hover { background: linear-gradient(180deg, #FA8A4D 0%, #F66933 100%); box-shadow: 0 14px 28px -6px rgba(245, 88, 29, 0.6); transform: translateY(-2px); }
  .btn-submit:active { transform: scale(0.96); }

  /* Bottom Nav */
  .navbar{position:absolute;bottom:0;left:0;right:0;display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0; z-index: 20;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:var(--orange-deep);}
  .navitem span{font-size:10.5px;font-weight:600;}

  ::-webkit-scrollbar{width:0;}
</style>
</head>
<body>
<div class="stage">
  <div class="caption">สหกรณ์ออมทรัพย์ครูไทย — คำนวณเงินกู้</div>
  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="status">
        <span>9:41</span>
        <span>●●●● 5G ▮▮▮</span>
      </div>
      
      <div class="topbar">
        <button class="back-btn" onclick="window.location.href='services.php'">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="page-title">คำนวณเงินกู้</div>
        <div class="placeholder"></div>
      </div>

      <div class="form-container">
        
        <div class="form-row">
          <div class="form-label">ประเภทเงินกู้</div>
          <div class="form-input-group">
            <select class="form-control">
              <option>เงินกู้ฉุกเฉิน (คนค้ำประกัน) (3.75%)</option>
              <option>เงินกู้ฉุกเฉิน (หุ้นค้ำประกัน) (3.75%)</option>
              <option>เงินกู้สามัญ (คนค้ำประกัน) (7%)</option>
            </select>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-label">วงเงินกู้</div>
          <div class="form-input-group">
            <div class="input-group">
              <input type="text" class="form-control" value="20,000">
              <span class="input-addon">บาท</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-label">อัตราดอกเบี้ย</div>
          <div class="form-input-group">
            <div class="input-group">
              <input type="text" class="form-control" value="3.75">
              <span class="input-addon">%</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-label">จำนวน</div>
          <div class="form-input-group flex-row">
            <select class="form-control" style="flex:1.4">
              <option>งวดที่ต้องการผ่อน</option>
              <option>เงินที่ต้องการผ่อนต่องวด</option>
            </select>
            <div class="input-group" style="flex:1">
              <input type="text" class="form-control" value="3">
              <span class="input-addon">งวด</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-label">วันที่กู้</div>
          <div class="form-input-group">
            <input type="text" id="loan_date" class="form-control" placeholder="เลือกวันที่กู้" readonly style="background-color: #fff; cursor: pointer;">
          </div>
        </div>

        <div class="form-row">
          <div class="form-label">ประเภทการชำระเงิน</div>
          <div class="form-input-group">
            <select class="form-control">
              <option>ชำระต้นเท่ากันทุกงวด</option>
              <option>ชำระยอดเท่ากันทุกงวด</option>
            </select>
          </div>
        </div>

        <button class="btn-submit">คำนวณ</button>
      </div>

    </div>
    <?php include 'nav_footer.php'; ?>
  </div>
</div>
<script>
  function setActiveNav(el) {
    // handled by inline onclick in nav_footer.php
  }

  // Flatpickr in Thai with Buddhist Era
  flatpickr("#loan_date", {
    locale: "th",
    defaultDate: "2026-09-01",
    disableMobile: "true", // Forces the custom flatpickr UI on mobile instead of native English UI
    onChange: function(selectedDates, dateStr, instance) {
      if(selectedDates.length > 0) {
        let d = selectedDates[0];
        let thaiMonths = ["ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
        let monthName = d.getMonth() === 0 ? "ม.ค." : thaiMonths[d.getMonth() - 1];
        instance.input.value = d.getDate() + " " + (d.getMonth() === 0 ? "ม.ค." : thaiMonths[d.getMonth() - 1]) + " " + (d.getFullYear() + 543);
      }
    },
    onReady: function(selectedDates, dateStr, instance) {
      if(selectedDates.length > 0) {
        let d = selectedDates[0];
        let thaiMonths = ["ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
        instance.input.value = d.getDate() + " " + (d.getMonth() === 0 ? "ม.ค." : thaiMonths[d.getMonth() - 1]) + " " + (d.getFullYear() + 543);
      }
    }
  });
</script>
</body>
</html>

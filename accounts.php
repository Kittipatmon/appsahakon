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
    background:#fff;
    border-radius:44px;border:10px solid #0b0f16;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.04);
    overflow:hidden;position:relative;display:flex;flex-direction:column;
  }
  .notch{position:absolute;top:0;left:50%;transform:translateX(-50%);width:120px;height:26px;background:#0b0f16;border-radius:0 0 16px 16px;z-index:50;}

  .scroll{flex:1;overflow-y:auto;background:#F6F8FA;}
  .status{display:flex;justify-content:space-between;align-items:center;padding:16px 26px 4px;font-size:13px;font-weight:600;color:var(--text);}
  
  .topbar { display:flex; align-items:center; padding: 10px 20px 24px; background: #F6F8FA; position: sticky; top:0; z-index: 10; }
  .page-title { font-size: 18px; font-weight: 700; color: var(--navy-deep); margin-left: auto; margin-right: auto; }
  
  .section { margin: 0 16px 26px; background: #fff; border-radius: 22px; box-shadow: 0 8px 24px -8px rgba(0,0,0,0.04); overflow: hidden; }
  .sec-title { padding: 18px 20px 14px; font-size: 15.5px; font-weight: 800; color: var(--navy-deep); border-bottom: 1px solid #F0F2F5; }
  
  .card { padding: 18px 20px; border-bottom: 1px solid #F0F2F5; cursor:pointer; transition:background 0.15s ease; }
  .card:active { background: #F9FAFB; }
  .card:last-child { border-bottom: none; }
  
  .card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
  .acc-type-wrap { display: flex; align-items: center; gap: 8px; }
  .badge-transfer { font-size: 10px; font-weight: 700; color: #2FAE7B; background: rgba(47,174,123,0.12); padding: 3px 8px; border-radius: 12px; }
  .acc-type { font-size: 14.5px; font-weight: 700; color: var(--text); }
  .acc-no { font-size: 11.5px; color: var(--text-muted); }
  .acc-bal { font-size: 20px; font-weight: 800; color: var(--navy-deep); text-align: right; margin-top: 4px; }
  .acc-bal span { font-size: 12.5px; color: var(--text-muted); font-weight: 500; margin-left: 4px; }
  
  .section.share { background: linear-gradient(135deg, var(--navy) 0%, var(--navy-deep) 100%); color: #fff; border: none; }
  .section.share .sec-title { color: #fff; border-bottom: 1px solid rgba(255,255,255,0.1); }
  .section.share .acc-type { color: #fff; }
  .section.share .acc-no { color: rgba(255,255,255,0.7); }
  .section.share .acc-bal { color: var(--orange-light); font-size: 24px; }
  .section.share .acc-bal span { color: rgba(255,255,255,0.7); }
  .section.share .card:active { background: rgba(255,255,255,0.05); }

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
</style>
</head>
<body>
<div class="stage">
  <div class="caption">สหกรณ์ออมทรัพย์ครูไทย — หน้าบัญชีของฉัน</div>

  <div class="phone">
    <div class="notch"></div>
    <div class="scroll">
      <div class="status">
        <span>9:41</span>
        <span>●●●● 5G ▮▮▮</span>
      </div>

      <div class="topbar">
        <div class="page-title">บัญชีของฉัน</div>
      </div>

      <div class="section share">
        <div class="sec-title">ทุนเรือนหุ้น</div>
        <div class="card">
          <div class="card-top">
            <div class="acc-type">ทุนเรือนหุ้นสะสม</div>
            <div class="acc-no">ส่งรายเดือน: ฿ <?= $accounts['shares']['monthly'] ?></div>
          </div>
          <div class="acc-bal"><?= $accounts['shares']['amount'] ?><span>บาท</span></div>
        </div>
      </div>

      <div class="section">
        <div class="sec-title">เงินฝาก</div>
        <?php foreach($accounts['deposits'] as $dep): ?>
        <div class="card">
          <div class="card-top">
            <div class="acc-type-wrap">
              <div class="acc-type"><?= $dep['type'] ?></div>
            </div>
            <div class="acc-no badge-transfer">เลขที่ <?= $dep['acc_no'] ?></div>
          </div>
          <div class="acc-bal"><?= $dep['balance'] ?><span>บาท</span></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="section">
        <div class="sec-title">เงินกู้</div>
        <?php foreach($accounts['loans'] as $loan): ?>
        <div class="card">
          <div class="card-top">
            <div class="acc-type"><?= $loan['type'] ?></div>
            <div class="acc-no">เลขที่ <?= $loan['acc_no'] ?></div>
          </div>
          <div class="acc-bal"><?= $loan['balance'] ?><span>บาท</span></div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>

    <?php include 'nav_footer.php'; ?>
  </div>
</div>
<script>
  function setActiveNav(el) {
    if(el.dataset.label) {
      // url redirect is handled by inline onclick in nav_footer.php
    }
  }
</script>
</body>
</html>

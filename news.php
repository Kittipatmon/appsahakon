<?php
// news.php
$allNews = [
    [
        'title'    => 'ประกาศอัตราดอกเบี้ยเงินฝากใหม่',
        'subtitle' => 'มีผลตั้งแต่ 1 กันยายน 2569 เป็นต้นไป',
        'date'     => '20 ส.ค. 2569',
        'color'    => 'linear-gradient(140deg, var(--orange), var(--orange-deep))'
    ],
    [
        'title'    => 'แจ้งเปลี่ยนแปลงเวลาทำการสหกรณ์',
        'subtitle' => 'เปิดให้บริการ 08.30 - 16.30 น. ทุกวันทำการ',
        'date'     => '18 ส.ค. 2569',
        'color'    => 'linear-gradient(140deg, var(--blue), #1C3A5E)'
    ],
    [
        'title'    => 'เชิญร่วมประชุมใหญ่สามัญประจำปี',
        'subtitle' => 'วันที่ 25 ตุลาคม 2569 ณ ห้องประชุมสมาคม',
        'date'     => '15 ส.ค. 2569',
        'color'    => 'linear-gradient(140deg, var(--green), #14805E)'
    ],
    [
        'title'    => 'เปิดรับสมัครทุนการศึกษาบุตรสมาชิก',
        'subtitle' => 'ยื่นเอกสารได้ตั้งแต่บัดนี้ถึง 15 พ.ย. 2569',
        'date'     => '10 ส.ค. 2569',
        'color'    => 'linear-gradient(140deg, var(--purple), #5E41C4)'
    ],
    [
        'title'    => 'รายงานผลการดำเนินงานครึ่งปีแรก',
        'subtitle' => 'สมาชิกสามารถดาวน์โหลดรายงานได้แล้ววันนี้',
        'date'     => '5 ส.ค. 2569',
        'color'    => 'linear-gradient(140deg, var(--red), #B82B2B)'
    ],
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ข่าวสารทั้งหมด</title>
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
    background: #fff;
    height: 100vh;
    height: 100dvh;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
  }

  .topbar{display:flex;align-items:center;justify-content:space-between;padding:36px 24px 20px;background:#fff;}
  .back-btn{cursor:pointer;display:flex;align-items:center;justify-content:center;padding:5px;margin:-5px;}
  .topbar-title{font-size:16px;font-weight:700;color:var(--text);}
  .placeholder{width:34px;}

  .scroll{flex:1;overflow-y:auto;padding-bottom:100px;background:#f9fafb;}
  .scroll::-webkit-scrollbar{width:0;}

  .news-list { padding: 16px 20px; display:flex; flex-direction: column; gap: 14px; }
  
  .news-card{display:flex;gap:14px;align-items:center;background:#fff;border-radius:16px;padding:12px;cursor:pointer;transition:transform .15s ease, box-shadow .15s ease;box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #f0f0f0;}
  .news-card:hover{transform:translateY(-2px);box-shadow: 0 8px 16px rgba(0,0,0,0.05);}
  .news-card:active{transform:translateY(0) scale(.98);}
  .news-thumb{width:60px;height:60px;border-radius:12px;flex-shrink:0; display:flex; align-items:center; justify-content:center; color:#fff;}
  .news-body { flex:1; }
  .news-body .n-date{font-size:10px;color:var(--orange-deep);font-weight:600;margin-bottom:2px;}
  .news-body .n1{font-size:13px;font-weight:700;color:var(--text);line-height:1.3;}
  .news-body .n2{font-size:11px;color:var(--text-muted);margin-top:4px;line-height:1.4;}

  /* Bottom Nav */
  .navbar{position:absolute;bottom:0;left:0;right:0;display:flex;justify-content:space-around;align-items:center;padding:10px 6px 22px;background:#fff;border-top:1px solid #F0F0F0;}
  .navitem{display:flex;flex-direction:column;align-items:center;gap:4px;color:#B7B7B7;cursor:pointer;transition:transform .15s ease;}
  .navitem:active{transform:scale(.9);}
  .navitem.active{color:#F5652B;}
  .navitem span{font-size:10.5px;font-weight:600;}

  .toast{
    position:absolute;left:50%;bottom:96px;transform:translateX(-50%) translateY(12px);
    background:rgba(28,28,28,.92);color:#fff;font-size:12.5px;font-weight:600;
    padding:10px 16px;border-radius:24px;white-space:nowrap;
    opacity:0;pointer-events:none;transition:opacity .18s ease, transform .18s ease;z-index:80;
    box-shadow:0 10px 24px -8px rgba(0,0,0,.5);
  }
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

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

  @media (max-width: 400px), (max-height: 750px) {
    .topbar { padding: 36px 16px 12px; }
    .topbar-title { font-size: 16px; }
    .news-list { padding: 12px 16px; }
  }
</style>
</head>
<body>
<div class="app-container">
    <div class="scroll">
      
      <div class="topbar">
        <div class="back-btn" onclick="window.location.href='index.php'">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1C1C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </div>
        <div class="topbar-title">ข่าวสารทั้งหมด</div>
        <div class="placeholder"></div>
      </div>

      <div class="news-list">
        <?php foreach ($allNews as $item): ?>
        <div class="news-card" onclick="go('<?= htmlspecialchars($item['title']) ?>')">
          <div class="news-thumb" style="background: <?= htmlspecialchars($item['color']) ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
          </div>
          <div class="news-body">
            <div class="n-date"><?= htmlspecialchars($item['date']) ?></div>
            <div class="n1"><?= htmlspecialchars($item['title']) ?></div>
            <div class="n2"><?= htmlspecialchars($item['subtitle']) ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      
    </div>

    <?php include 'nav_footer.php'; ?>

    <div class="toast" id="toast"></div>
</div>

<script>
  let toastTimer = null;
  function go(label){
    const el = document.getElementById('toast');
    el.textContent = 'อ่านข่าว: ' + label;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => el.classList.remove('show'), 1600);
  }
</script>
</body>
</html>

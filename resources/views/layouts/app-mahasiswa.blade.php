<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') — Sistem KRS & KHS POLIBATAM</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ═══════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════ */
:root {
  --navy:      #0a1628;
  --navy-2:    #0f2040;
  --navy-3:    #152b52;
  --blue:      #1a56db;
  --blue-lt:   #3b82f6;
  --blue-glow: rgba(26,86,219,.18);
  --cyan:      #06b6d4;
  --success:   #10b981;
  --warning:   #f59e0b;
  --danger:    #ef4444;
  --surface:   #ffffff;
  --surface-2: #f8fafd;
  --surface-3: #f1f5fb;
  --border:    #e4eaf5;
  --text:      #0a1628;
  --text-2:    #3d5080;
  --text-3:    #7c93b8;
  --sidebar-w: 240px;
  --radius-sm: 8px;
  --radius:    12px;
  --radius-lg: 18px;
  --shadow-xs: 0 1px 3px rgba(10,22,40,.06);
  --shadow:    0 2px 12px rgba(10,22,40,.08), 0 0 0 1px rgba(10,22,40,.04);
  --shadow-md: 0 8px 32px rgba(10,22,40,.14);
  --shadow-lg: 0 20px 60px rgba(10,22,40,.2);
  --font:      'DM Sans', sans-serif;
  --font-head: 'Syne', sans-serif;
}

*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--font);background:var(--surface-2);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased}

::-webkit-scrollbar{width:5px;height:5px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px}
::-webkit-scrollbar-thumb:hover{background:var(--text-3)}

/* ═══ LAYOUT ═══ */
.app{display:flex;min-height:100vh}

/* ═══ SIDEBAR ═══ */
.sidebar{
  width:var(--sidebar-w);background:var(--navy);
  display:flex;flex-direction:column;
  position:fixed;top:0;left:0;height:100vh;
  z-index:100;transition:transform .3s cubic-bezier(.4,0,.2,1);
  box-shadow:4px 0 32px rgba(0,0,0,.2);
}
.sb-logo{
  padding:22px 20px 18px;
  border-bottom:1px solid rgba(255,255,255,.07);
  display:flex;align-items:center;gap:11px;
}
.sb-logo-img{
  width:100%;
  max-height:58px;
  object-fit:contain;
  display:block;
  background:#fff;
  border-radius:10px;
  padding:5px;
}
.sb-logo-icon{
  width:38px;height:38px;border-radius:11px;
  background:white;display:flex;align-items:center;justify-content:center;
  font-family:var(--font-head);font-size:8px;font-weight:800;color:var(--navy);
  line-height:1.2;text-align:center;letter-spacing:-.3px;flex-shrink:0;
}
.sb-logo-name{font-family:var(--font-head);font-size:14px;font-weight:700;color:white}
.sb-logo-sub{font-size:10px;color:rgba(255,255,255,.4);margin-top:1px}
.sb-user{
  padding:14px 20px;border-bottom:1px solid rgba(255,255,255,.07);
  display:flex;align-items:center;gap:11px;
}
.sb-avatar{
  width:36px;height:36px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,var(--blue-lt),var(--cyan));
  display:flex;align-items:center;justify-content:center;
  font-size:12px;font-weight:700;color:white;
}
.sb-uname{font-size:13px;font-weight:600;color:white}
.sb-urole{font-size:10px;color:rgba(255,255,255,.4);margin-top:1px}
.sb-nav{flex:1;padding:10px 0;overflow-y:auto}
.sb-section{
  padding:14px 20px 5px;
  font-size:9px;font-weight:700;letter-spacing:1.2px;
  text-transform:uppercase;color:rgba(255,255,255,.25);
}
.sb-item{
  display:flex;align-items:center;gap:11px;
  padding:9px 20px;color:rgba(255,255,255,.55);
  cursor:pointer;font-size:13px;font-weight:500;
  transition:.15s;border-left:3px solid transparent;
  text-decoration:none;position:relative;
}
.sb-item:hover{color:rgba(255,255,255,.9);background:rgba(255,255,255,.06)}
.sb-item.active{
  color:white;background:rgba(255,255,255,.1);
  border-left-color:var(--blue-lt);font-weight:600;
}
.sb-item.active .sb-ic{color:var(--blue-lt)}
.sb-ic{width:17px;text-align:center;font-size:13px;transition:.15s}
.sb-pill{
  margin-left:auto;background:var(--blue);color:white;
  font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;
}
.sb-bottom{padding:14px 20px;border-top:1px solid rgba(255,255,255,.07)}
.sb-logout{
  display:flex;align-items:center;gap:10px;width:100%;
  background:none;border:none;color:rgba(255,255,255,.45);
  font-size:13px;font-weight:500;font-family:var(--font);
  cursor:pointer;padding:9px 12px;border-radius:var(--radius-sm);transition:.15s;
}
.sb-logout:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.8)}

/* ═══ TOPBAR ═══ */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{
  background:var(--surface);padding:0 32px;height:64px;
  display:flex;align-items:center;justify-content:space-between;
  border-bottom:1px solid var(--border);
  position:sticky;top:0;z-index:50;
  box-shadow:var(--shadow-xs);
}
.tb-left{display:flex;flex-direction:column;gap:2px}
.tb-title{font-family:var(--font-head);font-size:17px;font-weight:700;color:var(--text)}
.tb-crumb{font-size:11px;color:var(--text-3)}
.tb-right{display:flex;align-items:center;gap:16px}
.tb-notif{
  width:36px;height:36px;border-radius:var(--radius-sm);
  background:var(--surface-2);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  color:var(--text-2);cursor:pointer;font-size:14px;
  position:relative;transition:.15s;
}
.tb-notif:hover{background:var(--surface-3);color:var(--text)}
.tb-notif-dot{
  position:absolute;top:6px;right:6px;
  width:7px;height:7px;border-radius:50%;
  background:var(--danger);border:2px solid var(--surface);
}
.tb-profile{
  display:flex;align-items:center;gap:10px;cursor:pointer;
  padding:6px 10px 6px 6px;border-radius:var(--radius-sm);transition:.15s;
}
.tb-profile:hover{background:var(--surface-2)}
.tb-av{
  width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,var(--blue-lt),var(--cyan));
  display:flex;align-items:center;justify-content:center;
  font-size:12px;font-weight:700;color:white;flex-shrink:0;
}
.tb-pname{font-size:13px;font-weight:600;color:var(--text)}
.tb-prole{font-size:11px;color:var(--text-3)}

/* ═══ CONTENT ═══ */
.content{padding:28px 32px;flex:1}
.page{animation:fadeUp .22s ease}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* ═══ PAGE HEADER ═══ */
.ph{margin-bottom:24px;display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:12px}
.ph-text h2{font-family:var(--font-head);font-size:22px;font-weight:800;color:var(--text)}
.ph-text p{font-size:13px;color:var(--text-3);margin-top:3px}

/* ═══ CARD ═══ */
.card{
  background:var(--surface);border-radius:var(--radius);
  box-shadow:var(--shadow);border:1px solid var(--border);
  overflow:hidden;
}
.card-hd{
  padding:18px 22px;border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;
}
.card-hd h3{font-family:var(--font-head);font-size:15px;font-weight:700;color:var(--text)}
.card-hd p{font-size:12px;color:var(--text-3);margin-top:2px}
.card-bd{padding:22px}

/* ═══ STAT CARDS ═══ */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.stat{
  background:var(--surface);border-radius:var(--radius);
  padding:20px;box-shadow:var(--shadow);border:1px solid var(--border);
  display:flex;align-items:flex-start;gap:16px;
  transition:.2s;cursor:default;
}
.stat:hover{transform:translateY(-2px);box-shadow:var(--shadow-md)}
.stat-ic{width:46px;height:46px;border-radius:12px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:18px;}
.ic-blue{background:#eff6ff;color:var(--blue)}
.ic-green{background:#ecfdf5;color:var(--success)}
.ic-amber{background:#fffbeb;color:var(--warning)}
.ic-purple{background:#f5f3ff;color:#7c3aed}
.stat-n{font-family:var(--font-head);font-size:28px;font-weight:800;color:var(--text);line-height:1}
.stat-l{font-size:12px;color:var(--text-3);margin-top:4px}
.stat-chg{font-size:11px;font-weight:600;margin-top:8px;display:inline-flex;align-items:center;gap:4px;padding:2px 7px;border-radius:100px;}
.chg-up{background:#ecfdf5;color:var(--success)}
.chg-dn{background:#fef2f2;color:var(--danger)}

/* ═══ TOOLBAR ═══ */
.toolbar{padding:16px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.t-left{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.search{position:relative;display:flex;align-items:center;}
.search-ic{position:absolute;left:11px;color:var(--text-3);font-size:12px;pointer-events:none}
.search input{padding:8px 12px 8px 32px;width:220px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:13px;font-family:var(--font);color:var(--text);background:var(--surface-2);outline:none;transition:.15s;}
.search input:focus{border-color:var(--blue);background:var(--surface);box-shadow:0 0 0 3px var(--blue-glow)}
.search input::placeholder{color:var(--text-3)}
.t-select{padding:8px 30px 8px 12px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:13px;font-family:var(--font);color:var(--text);background:var(--surface-2) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%237c93b8' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 10px center;appearance:none;outline:none;cursor:pointer;transition:.15s;}
.t-select:focus{border-color:var(--blue);background:var(--surface)}

/* ═══ TABLE ═══ */
.tbl-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
thead th{background:var(--surface-2);padding:10px 16px;text-align:left;font-size:10px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.8px;border-bottom:1px solid var(--border);white-space:nowrap;}
tbody td{padding:13px 16px;border-bottom:1px solid var(--border);font-size:13px;vertical-align:middle;color:var(--text);transition:background .1s;}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover td{background:var(--surface-3)}
.td-strong{font-weight:600;color:var(--navy);font-family:var(--font-head);font-size:12px}

/* ═══ BADGES ═══ */
.badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:100px;font-size:11px;font-weight:600;white-space:nowrap;}
.badge::before{content:'';width:5px;height:5px;border-radius:50%;background:currentColor}
.b-success{background:#ecfdf5;color:#059669}
.b-warning{background:#fffbeb;color:#d97706}
.b-danger{background:#fef2f2;color:#dc2626}
.b-info{background:#eff6ff;color:#2563eb}
.b-gray{background:#f1f5f9;color:#64748b}

/* ═══ BUTTONS ═══ */
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--radius-sm);font-size:13px;font-weight:600;cursor:pointer;border:none;font-family:var(--font);transition:.15s;white-space:nowrap;text-decoration:none;}
.btn:hover{transform:translateY(-1px)}
.btn-primary{background:var(--navy);color:white}
.btn-primary:hover{background:var(--navy-2);box-shadow:var(--shadow-md)}
.btn-blue{background:var(--blue);color:white}
.btn-blue:hover{background:#1447c4;box-shadow:0 4px 12px rgba(26,86,219,.3)}
.btn-success{background:var(--success);color:white}
.btn-success:hover{background:#059669}
.btn-danger{background:var(--danger);color:white}
.btn-danger:hover{background:#dc2626}
.btn-warning{background:var(--warning);color:white}
.btn-warning:hover{background:#d97706}
.btn-ghost{background:var(--surface-2);color:var(--text-2);border:1.5px solid var(--border)}
.btn-ghost:hover{background:var(--surface-3);color:var(--text)}
.btn-sm{padding:7px 14px;font-size:12px}
.btn-xs{padding:4px 10px;font-size:11px;border-radius:6px}

/* ═══ PAGINATION ═══ */
.pagination{padding:16px 22px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.pg-info{font-size:12px;color:var(--text-3)}
.pg-btns{display:flex;gap:4px}
.pg-btn{width:32px;height:32px;border-radius:7px;display:inline-flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;cursor:pointer;border:1.5px solid var(--border);background:var(--surface);color:var(--text-2);transition:.15s;}
.pg-btn:hover{border-color:var(--blue);color:var(--blue);background:var(--surface-2)}
.pg-btn.active{background:var(--navy);color:white;border-color:var(--navy)}
.pg-btn.pg-arr{font-size:11px}

/* ═══ FORM ═══ */
.f-grid{display:grid;gap:18px}
.f-grid-2{grid-template-columns:1fr 1fr}
.f-lbl{display:block;font-size:11px;font-weight:600;color:var(--text-2);margin-bottom:7px;text-transform:uppercase;letter-spacing:.5px}
.f-ctrl{width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:13px;font-family:var(--font);color:var(--text);background:var(--surface);outline:none;transition:.15s;}
.f-ctrl:focus{border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-glow)}
.f-ctrl::placeholder{color:var(--text-3)}
.f-sel{width:100%;padding:10px 30px 10px 13px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:13px;font-family:var(--font);color:var(--text);background:var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%237c93b8' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 12px center;appearance:none;outline:none;cursor:pointer;transition:.15s;}
.f-sel:focus{border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-glow)}
.f-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:24px;padding-top:18px;border-top:1px solid var(--border);}

/* ═══ ALERT ═══ */
.alert{padding:12px 16px;border-radius:var(--radius-sm);font-size:13px;display:flex;align-items:center;gap:10px;margin-bottom:18px;}
.alert-info{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe}
.alert-success{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
.alert-warn{background:#fffbeb;color:#92400e;border:1px solid #fde68a}

/* ═══ MODAL ═══ */
.overlay{position:fixed;inset:0;background:rgba(10,22,40,.5);z-index:200;display:none;align-items:center;justify-content:center;backdrop-filter:blur(3px);padding:20px;}
.overlay.open{display:flex;animation:fadeIn .15s ease}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
.modal{background:var(--surface);border-radius:var(--radius-lg);width:520px;max-width:100%;max-height:90vh;overflow-y:auto;box-shadow:var(--shadow-lg);animation:modalIn .2s cubic-bezier(.34,1.4,.64,1);}
@keyframes modalIn{from{opacity:0;transform:scale(.95) translateY(-8px)}to{opacity:1;transform:scale(1) translateY(0)}}
.modal-sm{width:400px}
.modal-hd{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:var(--surface);z-index:1;}
.modal-hd h4{font-family:var(--font-head);font-size:16px;font-weight:700}
.modal-x{width:32px;height:32px;border-radius:8px;background:var(--surface-2);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-3);font-size:13px;transition:.15s;}
.modal-x:hover{background:var(--surface-3);color:var(--text)}
.modal-bd{padding:24px}
.modal-ft{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;justify-content:flex-end;}

/* ═══ NILAI INPUT ═══ */
.nilai-input{width:72px;padding:6px 9px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;font-family:var(--font);text-align:center;outline:none;transition:.15s;background:var(--surface-2);}
.nilai-input:focus{border-color:var(--blue);background:var(--surface);box-shadow:0 0 0 3px var(--blue-glow)}
.grade-select{width:76px;padding:6px 22px 6px 9px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;font-family:var(--font);background:var(--surface-2) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='9' height='9' viewBox='0 0 24 24' fill='none' stroke='%237c93b8' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 8px center;appearance:none;outline:none;cursor:pointer;transition:.15s;}

/* ═══ PROFILE ═══ */
.profile-grid{display:grid;grid-template-columns:280px 1fr;gap:20px}
.profile-card{background:var(--surface);border-radius:var(--radius-lg);padding:28px 22px;box-shadow:var(--shadow);border:1px solid var(--border);text-align:center;align-self:start;}
.profile-av{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--blue-lt),var(--cyan));display:flex;align-items:center;justify-content:center;font-family:var(--font-head);font-size:24px;font-weight:800;color:white;margin:0 auto 14px;box-shadow:0 8px 24px rgba(59,130,246,.3);}
.profile-name{font-family:var(--font-head);font-size:17px;font-weight:700}
.profile-role{font-size:12px;color:var(--text-3);margin:3px 0 14px}
.profile-info{text-align:left;border-top:1px solid var(--border);padding-top:16px;margin-top:4px;}
.pi-label{font-size:10px;font-weight:700;color:var(--text-3);letter-spacing:.8px;text-transform:uppercase;margin-bottom:10px}
.pi-row{display:flex;align-items:center;gap:10px;font-size:13px;color:var(--text);margin-bottom:8px;}
.pi-row i{width:16px;color:var(--text-3);font-size:12px}

/* ═══ KRS ═══ */
.krs-detail-meta{display:flex;flex-wrap:wrap;gap:20px;padding:16px 18px;background:var(--surface-2);border-radius:var(--radius-sm);margin-bottom:18px;border:1px solid var(--border);}
.kdm-item span{font-size:11px;color:var(--text-3);display:block;margin-bottom:2px}
.kdm-item strong{font-size:13px;font-weight:600;color:var(--text)}
.krs-total{display:flex;align-items:center;justify-content:space-between;padding:16px 0 0;border-top:1px solid var(--border);margin-top:4px;flex-wrap:wrap;gap:12px;}

/* ═══ DASHBOARD ═══ */
.dash-grid{display:grid;grid-template-columns:1fr 360px;gap:18px}
.activity-list{display:flex;flex-direction:column;gap:0}
.act-item{display:flex;align-items:flex-start;gap:13px;padding:14px 0;border-bottom:1px solid var(--border);}
.act-item:last-child{border-bottom:none;padding-bottom:0}
.act-ic{width:34px;height:34px;border-radius:9px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:12px;}
.act-txt{font-size:13px;font-weight:500;color:var(--text)}
.act-time{font-size:11px;color:var(--text-3);margin-top:2px}

/* ═══ MOBILE ═══ */
.ham{display:none;width:36px;height:36px;align-items:center;justify-content:center;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-sm);cursor:pointer;color:var(--text-2);font-size:15px;}
.sb-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:99;backdrop-filter:blur(2px);}

@media(max-width:1200px){
  .stat-grid{grid-template-columns:repeat(2,1fr)}
  .dash-grid{grid-template-columns:1fr}
}
@media(max-width:900px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .sb-overlay.open{display:block}
  .ham{display:flex}
  .topbar{padding:0 20px}
  .content{padding:20px}
  .f-grid-2{grid-template-columns:1fr}
  .profile-grid{grid-template-columns:1fr}
}
@media(max-width:600px){
  .stat-grid{grid-template-columns:1fr}
  .modal{width:100%}
  .search input{width:160px}
  .pagination{flex-direction:column;align-items:flex-start}
}
</style>
@stack('styles')
</head>
<body>
<div class="app">

 {{-- SIDEBAR MAHASISWA --}}
@include('layouts.sidebar-mahasiswa')
<div class="sb-overlay" id="sbOverlay" onclick="toggleSidebar(false)"></div>

{{-- MAIN --}}
<main class="main">
    <div class="content">
      @yield('content')
    </div>

  </main>

</div>

{{-- MODALS (shared) --}}
@stack('modals')

{{-- Global Modal: Konfirmasi Hapus --}}
<div id="mDelete" class="overlay">
  <div class="modal modal-sm">
    <div class="modal-hd">
      <h4>Konfirmasi Hapus</h4>
      <div class="modal-x" onclick="closeModal('mDelete')"><i class="fas fa-times"></i></div>
    </div>
    <div class="modal-bd" style="text-align:center;padding:32px 24px">
      <div style="width:64px;height:64px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:var(--danger)">
        <i class="fas fa-trash-alt"></i>
      </div>
      <div style="font-family:var(--font-head);font-size:17px;font-weight:700;margin-bottom:8px">Hapus Data?</div>
      <div style="font-size:13px;color:var(--text-3);line-height:1.6" id="deleteMsg">Tindakan ini tidak dapat dibatalkan.</div>
    </div>
    <div class="modal-ft">
      <button class="btn btn-ghost" onclick="closeModal('mDelete')">Batal</button>
      <form id="deleteForm" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" onclick="doDelete()">
        Ya, Hapus
        </button>
      </form>
    </div>
  </div>
</div>

<script>
function openModal(id)  { document.getElementById(id).classList.add('open') }
function closeModal(id) { document.getElementById(id).classList.remove('open') }

document.querySelectorAll('.overlay').forEach(o => {
  o.addEventListener('click', e => { if (e.target === o) o.classList.remove('open') })
});

let currentRow = null;

function confirmDelete(label, action) {
  document.getElementById('deleteMsg').textContent =
    `Apakah Anda yakin ingin menghapus ${label}? Tindakan ini tidak dapat dibatalkan.`;

  // simpan baris yang diklik (untuk demo hapus)
  currentRow = event.target.closest('tr');

  // tetap set action (biar tampilan tidak berubah, walau tidak dipakai)
  if (action) {
    document.getElementById('deleteForm').setAttribute('data-action', action);
  }

  openModal('mDelete');
}

function toggleSidebar(force) {
  const sb = document.getElementById('sidebar');
  const ov = document.getElementById('sbOverlay');
  const isOpen = sb.classList.contains('open');
  const shouldOpen = force !== undefined ? force : !isOpen;
  sb.classList.toggle('open', shouldOpen);
  if (ov) ov.classList.toggle('open', shouldOpen);
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape')
    document.querySelectorAll('.overlay.open').forEach(o => o.classList.remove('open'));
});
</script>
@stack('scripts')
</body>
</html>

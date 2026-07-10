<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Sistem KRS & KHS POLIBATAM</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<style>
  :root {
    --primary: #1e3a8a;
    --primary-dark: #1e2d6b;
    --primary-light: #2b4fc2;
    --accent: #3b82f6;
    --accent-hover: #2563eb;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --sidebar-w: 220px;
    --bg: #f1f5f9;
    --card: #ffffff;
    --text: #1e293b;
    --muted: #64748b;
    --border: #e2e8f0;
    --sidebar-text: rgba(255,255,255,0.85);
    --sidebar-active: rgba(255,255,255,0.15);
    --radius: 12px;
    --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.06);
    --shadow-md: 0 4px 20px rgba(30,58,138,0.15);
  }
 
  * { margin:0; padding:0; box-sizing:border-box; }
 
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
  }
 
  /* ── LOGIN PAGE ── */
  .login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e40af 100%);
    position: relative;
    overflow: hidden;
  }
  .login-page::before {
    content:'';
    position:absolute;
    width:600px; height:600px;
    border-radius:50%;
    background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);
    top:-100px; right:-100px;
    pointer-events:none;
  }
  .login-page::after {
    content:'';
    position:absolute;
    width:400px; height:400px;
    border-radius:50%;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
    bottom:-50px; left:-50px;
    pointer-events:none;
  }
  .login-card {
    background: white;
    border-radius: 20px;
    padding: 48px 40px;
    width: 400px;
    box-shadow: 0 25px 80px rgba(0,0,0,0.35);
    position: relative;
    z-index: 2;
  }
  .login-logo {
    display:flex; align-items:center; gap:12px;
    margin-bottom:28px;
  }
  .login-logo .logo-icon {
    width:48px; height:48px; border-radius:12px;
    background: var(--primary);
    display:flex; align-items:center; justify-content:center;
    color:white; font-weight:800; font-size:14px;
    letter-spacing:-0.5px;
  }
  .login-logo .logo-img {
    width: 190px;
    max-width: 100%;
    height: auto;
    display: block;
  }
  .login-logo .logo-text { font-weight:700; font-size:17px; color:var(--primary); line-height:1.2; }
  .login-logo .logo-sub  { font-size:11px; color:var(--muted); font-weight:400; }
  .login-title { font-size:22px; font-weight:700; color:var(--text); margin-bottom:6px; }
  .login-subtitle { font-size:13px; color:var(--muted); margin-bottom:32px; }
  .form-group { margin-bottom:18px; }
  .form-group label { display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px; }
  .form-control {
    width:100%; padding:11px 14px;
    border: 1.5px solid var(--border);
    border-radius:10px;
    font-size:14px; font-family:inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline:none; color:var(--text);
  }
  .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }
  .form-select {
    width:100%; padding:11px 14px;
    border: 1.5px solid var(--border);
    border-radius:10px;
    font-size:14px; font-family:inherit;
    background:white; cursor:pointer; outline:none;
    appearance:none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right:36px;
  }
  .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }
  .input-wrap { position:relative; }
  .input-wrap .form-control { padding-right:42px; }
  .input-wrap .eye-toggle { position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:var(--muted); font-size:14px; }
  .btn-login {
    width:100%; padding:13px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color:white; border:none; border-radius:10px;
    font-size:14px; font-weight:700; letter-spacing:0.5px;
    cursor:pointer; transition: all 0.2s;
    font-family:inherit; margin-top:8px;
  }
  .btn-login:hover { transform:translateY(-1px); box-shadow: var(--shadow-md); }
  .forgot-link { display:block; text-align:center; margin-top:16px; font-size:13px; color:var(--accent); text-decoration:none; font-weight:500; cursor:pointer; }
  .forgot-link:hover { text-decoration:underline; }
 
  /* ── LAYOUT ── */
  .app-layout { display:flex; min-height:100vh; }
 
  /* ── SIDEBAR ── */
  .sidebar {
    width: var(--sidebar-w);
    background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
    display:flex; flex-direction:column;
    position:fixed; top:0; left:0; height:100vh;
    z-index:100; transition:transform 0.3s;
    box-shadow: 4px 0 24px rgba(0,0,0,0.15);
  }
  .sidebar-logo {
    padding:20px 16px;
    display:flex; align-items:center; gap:10px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .sidebar-logo .s-icon {
    width:36px; height:36px; border-radius:10px;
    background:white; display:flex; align-items:center; justify-content:center;
    color:var(--primary); font-weight:800; font-size:11px;
  }
  .sidebar-logo .s-name { color:white; font-weight:700; font-size:14px; line-height:1.2; }
  .sidebar-logo .s-sub  { color:rgba(255,255,255,0.55); font-size:10px; }
  .sidebar-user {
    padding:14px 16px; display:flex; align-items:center; gap:10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .user-avatar {
    width:34px; height:34px; border-radius:50%;
    background: var(--accent); color:white;
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:700; flex-shrink:0;
  }
  .user-name { color:white; font-size:12px; font-weight:600; }
  .user-role { color:rgba(255,255,255,0.5); font-size:10px; }
  .sidebar-nav { flex:1; padding:8px 0; overflow-y:auto; }
  .nav-label { padding:10px 16px 4px; font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.35); }
  .nav-item {
    display:flex; align-items:center; gap:10px;
    padding:9px 16px; color:var(--sidebar-text);
    cursor:pointer; transition: all 0.15s;
    font-size:13px; font-weight:500;
    border-left:3px solid transparent;
    text-decoration:none;
  }
  .nav-item:hover { background:var(--sidebar-active); color:white; }
  .nav-item.active { background:var(--sidebar-active); color:white; border-left-color:rgba(255,255,255,0.8); font-weight:600; }
  .nav-item i { width:16px; text-align:center; font-size:13px; opacity:0.8; }
  .sidebar-logout {
    padding:12px 16px;
    border-top: 1px solid rgba(255,255,255,0.1);
  }
  .btn-logout {
    display:flex; align-items:center; gap:8px;
    color:rgba(255,255,255,0.65); font-size:12px; font-weight:500;
    cursor:pointer; padding:8px 12px; border-radius:8px;
    transition:all 0.15s; width:100%; border:none; background:none;
    font-family:inherit;
  }
  .btn-logout:hover { background:rgba(255,255,255,0.1); color:white; }
 
  /* ── MAIN ── */
  .main-content {
    margin-left: var(--sidebar-w);
    flex:1; display:flex; flex-direction:column;
    min-height:100vh;
  }
  .topbar {
    background:white; padding:14px 28px;
    display:flex; align-items:center; justify-content:space-between;
    border-bottom: 1px solid var(--border);
    position:sticky; top:0; z-index:50;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
  }
  .topbar-title { font-size:17px; font-weight:700; color:var(--text); }
  .topbar-breadcrumb { font-size:12px; color:var(--muted); margin-top:1px; }
  .topbar-right { display:flex; align-items:center; gap:12px; }
  .topbar-avatar {
    width:36px; height:36px; border-radius:50%;
    background: var(--primary); color:white;
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:700; cursor:pointer;
  }
  .topbar-name { font-size:13px; font-weight:600; }
  .content-area { padding:28px; flex:1; }
 
  /* ── PAGE ── */
  .page { display:none; animation: fadeIn 0.2s ease; }
  .page.active { display:block; }
  @keyframes fadeIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }
 
  /* ── CARDS ── */
  .card {
    background:var(--card); border-radius:var(--radius);
    box-shadow: var(--shadow); overflow:hidden;
  }
  .card-header {
    padding:18px 22px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:10px;
  }
  .card-header h3 { font-size:16px; font-weight:700; color:var(--text); }
  .card-body { padding:22px; }
 
  /* ── STAT CARDS ── */
  .stat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:24px; }
  .stat-card {
    background:var(--card); border-radius:var(--radius);
    padding:22px; box-shadow:var(--shadow);
    display:flex; align-items:center; gap:16px;
    transition:transform 0.2s;
  }
  .stat-card:hover { transform:translateY(-2px); }
  .stat-icon {
    width:52px; height:52px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:20px; flex-shrink:0;
  }
  .stat-icon.blue   { background:#eff6ff; color:var(--accent); }
  .stat-icon.green  { background:#ecfdf5; color:var(--success); }
  .stat-icon.indigo { background:#eef2ff; color:#6366f1; }
  .stat-num   { font-size:26px; font-weight:800; color:var(--text); line-height:1; }
  .stat-label { font-size:12px; color:var(--muted); margin-top:3px; }
  .stat-link  { font-size:11px; color:var(--accent); cursor:pointer; margin-top:4px; font-weight:600; }
  .stat-link:hover { text-decoration:underline; }
 
  /* ── TABLE ── */
  .table-wrap { overflow-x:auto; }
  table { width:100%; border-collapse:collapse; }
  thead th {
    background:#f8fafc; padding:10px 14px;
    text-align:left; font-size:11px; font-weight:700;
    color:var(--muted); text-transform:uppercase; letter-spacing:0.5px;
    border-bottom:1px solid var(--border); white-space:nowrap;
  }
  tbody td {
    padding:12px 14px; border-bottom:1px solid var(--border);
    font-size:13px; vertical-align:middle;
  }
  tbody tr:last-child td { border-bottom:none; }
  tbody tr:hover td { background:#f8fafc; }
 
  /* ── BADGES ── */
  .badge {
    display:inline-block; padding:3px 10px; border-radius:20px;
    font-size:11px; font-weight:600;
  }
  .badge-success { background:#ecfdf5; color:#059669; }
  .badge-warning { background:#fffbeb; color:#d97706; }
  .badge-danger  { background:#fef2f2; color:#dc2626; }
  .badge-info    { background:#eff6ff; color:#2563eb; }
 
  /* ── BUTTONS ── */
  .btn {
    display:inline-flex; align-items:center; gap:6px;
    padding:8px 16px; border-radius:8px;
    font-size:13px; font-weight:600; cursor:pointer;
    border:none; font-family:inherit; transition:all 0.15s;
    text-decoration:none; white-space:nowrap;
  }
  .btn-primary { background:var(--primary); color:white; }
  .btn-primary:hover { background:var(--primary-light); transform:translateY(-1px); box-shadow:var(--shadow-md); }
  .btn-success { background:var(--success); color:white; }
  .btn-success:hover { background:#059669; }
  .btn-danger  { background:var(--danger); color:white; }
  .btn-danger:hover  { background:#dc2626; }
  .btn-outline {
    background:transparent; color:var(--primary);
    border:1.5px solid var(--primary);
  }
  .btn-outline:hover { background:var(--primary); color:white; }
  .btn-sm { padding:5px 11px; font-size:12px; }
  .btn-xs { padding:3px 9px; font-size:11px; }
  .btn-warning { background:var(--warning); color:white; }
  .btn-warning:hover { background:#d97706; }
 
  /* ── TOOLBAR ── */
  .toolbar {
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:12px; margin-bottom:16px;
  }
  .toolbar-left { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
  .search-box {
    position:relative; display:flex; align-items:center;
  }
  .search-box i { position:absolute; left:10px; color:var(--muted); font-size:13px; }
  .search-box input {
    padding:8px 12px 8px 32px;
    border:1.5px solid var(--border); border-radius:8px;
    font-size:13px; font-family:inherit; outline:none; width:200px;
  }
  .search-box input:focus { border-color:var(--accent); }
  .filter-select {
    padding:8px 28px 8px 12px;
    border:1.5px solid var(--border); border-radius:8px;
    font-size:13px; font-family:inherit; outline:none;
    background:white; cursor:pointer;
    appearance:none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 10px center;
  }
  .filter-select:focus { border-color:var(--accent); }
 
  /* ── FORMS ── */
  .form-grid { display:grid; gap:18px; }
  .form-grid.col-2 { grid-template-columns:1fr 1fr; }
  .form-label { display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.4px; }
  .form-actions { display:flex; gap:10px; justify-content:flex-end; margin-top:24px; padding-top:18px; border-top:1px solid var(--border); }
 
  /* ── MODAL / OVERLAY ── */
  .modal-overlay {
    position:fixed; inset:0; background:rgba(0,0,0,0.4);
    z-index:200; display:none; align-items:center; justify-content:center;
    backdrop-filter:blur(2px);
  }
  .modal-overlay.open { display:flex; }
  .modal {
    background:white; border-radius:16px;
    width:520px; max-width:95vw; max-height:90vh; overflow-y:auto;
    box-shadow:0 20px 60px rgba(0,0,0,0.2);
    animation: modalIn 0.2s ease;
  }
  @keyframes modalIn { from { opacity:0; transform:scale(0.95) translateY(-10px); } to { opacity:1; transform:scale(1) translateY(0); } }
  .modal-header { padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
  .modal-header h4 { font-size:16px; font-weight:700; }
  .modal-close { cursor:pointer; color:var(--muted); font-size:18px; }
  .modal-close:hover { color:var(--text); }
  .modal-body { padding:24px; }
  .modal-footer { padding:16px 24px; border-top:1px solid var(--border); display:flex; gap:10px; justify-content:flex-end; }
 
  /* ── ALERT ── */
  .alert {
    padding:12px 16px; border-radius:10px;
    font-size:13px; display:flex; align-items:flex-start; gap:10px;
    margin-bottom:16px;
  }
  .alert-info { background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; }
  .alert-success { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
 
  /* ── SECTION TITLE ── */
  .section-header { margin-bottom:20px; }
  .section-header h2 { font-size:20px; font-weight:800; color:var(--text); }
  .section-header p { font-size:13px; color:var(--muted); margin-top:3px; }
 
  /* ── KRS APPROVAL TABLE ── */
  .approval-meta { display:flex; gap:20px; margin-bottom:16px; font-size:13px; }
  .approval-meta span { color:var(--muted); }
  .approval-meta strong { color:var(--text); }
  .approval-total { display:flex; align-items:center; justify-content:space-between; padding:14px 0 0; border-top:1px solid var(--border); margin-top:12px; }
 
  /* ── INPUT NILAI ── */
  .mk-selector {
    display:flex; gap:12px; align-items:center; margin-bottom:20px;
    flex-wrap:wrap;
  }
  .mk-selector .filter-select { min-width:220px; }
 
  /* Scrollbar */
  ::-webkit-scrollbar { width:6px; height:6px; }
  ::-webkit-scrollbar-track { background:transparent; }
  ::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:3px; }
</style>

<div class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <img class="logo-img" src="{{ asset('images/polibatam-logo.png') }}" alt="POLIBATAM - Politeknik Negeri Batam">
        </div>
        <div class="login-title">Sistem KRS dan KHS</div>
        <div class="login-subtitle">Politeknik Negeri Batam</div>

        @if($errors->any())
            <div style="padding:10px 12px;border-radius:10px;background:#fef2f2;color:#991b1b;font-size:12px;margin-bottom:18px;border:1px solid #fecaca;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="form-group">
        <label>NIM / NIDN</label>
        <input class="form-control"
               type="text"
               name="nim"
               placeholder="Masukkan NIM atau NIDN"
               required>
    </div>

    <div class="form-group">
        <label>Password</label>

        <div class="input-wrap">
            <input class="form-control"
                   type="password"
                   name="password"
                   id="loginPass"
                   placeholder="Masukkan password"
                   required>

            <span class="eye-toggle" onclick="togglePass()">
                <i class="fas fa-eye-slash" id="eyeIcon"></i>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label>Login Sebagai</label>

        <select class="form-select" name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="dosen">Dosen</option>
            <option value="mahasiswa">Mahasiswa</option>
        </select>
    </div>

	    <button type="submit" class="btn-login">
	        LOGIN
	    </button>
</form>
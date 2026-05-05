{{-- resources/views/layouts/partials/topbar.blade.php --}}
<header class="topbar">
  <div style="display:flex;align-items:center;gap:14px">
    <div class="ham" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
    <div class="tb-left">
      <div class="tb-title">@yield('page_title', 'Dashboard')</div>
      <div class="tb-crumb">Admin / @yield('page_title', 'Dashboard')</div>
    </div>
  </div>
  <div class="tb-right">
    <div class="tb-notif">
      <i class="fas fa-bell"></i>
      <div class="tb-notif-dot"></div>
    </div>
    <div class="tb-profile">
      <div class="tb-av">{{ strtoupper(substr(auth()->user()->name ?? 'EM', 0, 2)) }}</div>
      <div>
        <div class="tb-pname">{{ auth()->user()->name ?? 'Ema Merlisa' }}</div>
        <div class="tb-prole">{{ auth()->user()->role ?? 'Administrator' }}</div>
      </div>
    </div>
  </div>
</header>
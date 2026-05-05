{{-- resources/views/layouts/partials/topbar.blade.php --}}
<header class="topbar">
  <div style="display:flex;align-items:center;gap:14px">
    <div class="ham" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
    </div>

    <div class="tb-left">
      <div class="tb-title">
        @yield('page_title', 'Dashboard')
      </div>
    </div>
  </div>

  <div class="tb-right">

    <!-- ✅ PROFILE (FIX) -->
    <a href="{{ route('profile') }}" style="text-decoration:none;color:inherit;">
      <div class="tb-profile" style="cursor:pointer;">
        
        <div class="tb-pname">
          {{ auth()->user()->name ?? 'User' }}
        </div>

        <div class="tb-av">
          {{ strtoupper(substr(auth()->user()->name ?? 'EM', 0, 2)) }}
        </div>

      </div>
    </a>

  </div>
</header>
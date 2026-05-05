{{-- resources/views/layouts/partials/sidebar.blade.php --}}
<aside class="sidebar-simple">

  <h2 class="logo">POLIBATAM</h2>

  <nav>
    <a href="/dashboard" class="item">
      <i class="fas fa-th-large"></i>
      <span>Dashboard</span>
    </a>

    <a href="/matakuliah" class="item">
      <i class="fas fa-book"></i>
      <span>Mata Kuliah</span>
    </a>

    <a href="/mahasiswa" class="item">
      <i class="fas fa-user-graduate"></i>
      <span>Mahasiswa</span>
    </a>

    <a href="/dosen" class="item">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>Dosen</span>
    </a>

    <a href="/krs" class="item">
      <i class="fas fa-file-alt"></i>
      <span>KRS</span>
    </a>

    <a href="/khs" class="item">
      <i class="fas fa-star"></i>
      <span>KHS</span>
    </a>
  </nav>

  <a href="/" class="logout">
    <i class="fas fa-sign-out-alt"></i>
    <span>Keluar</span>
  </a>

</aside>
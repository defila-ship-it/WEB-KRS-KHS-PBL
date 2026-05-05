{{-- resources/views/pages/mahasiswa/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mahasiswa')
@section('page_title', 'Mahasiswa')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Mahasiswa</h2>
    <p>Manajemen data mahasiswa aktif</p>
  </div>
  <button class="btn btn-sm btn-add" onclick="window.location.href='/mahasiswa/create'">
    <i class="fas fa-plus"></i> Tambah Mahasiswa
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="card">
  <div class="toolbar">
    <div class="t-left">
      <div class="search"><i class="fas fa-search search-ic"></i><input type="text" placeholder="Cari mahasiswa..."></div>
      <select class="t-select">
        <option>Semua Semester</option>
        @for($i = 1; $i <= 8; $i++)
          <option>{{ $i }}</option>
        @endfor
      </select>
      <select class="t-select">
        <option>Semua Prodi</option>
        <option>Teknik Informatika</option>
        <option>Teknik Elektro</option>
        <option>Manajemen Bisnis</option>
      </select>
    </div>
  </div>

  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Lengkap</th>
          <th>Program Studi</th>
          <th>Angkatan</th>
          <th>Semester</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="td-strong">12345</td>
          <td>Budi Santoso</td>
          <td>Teknik Informatika</td>
          <td>2022</td>
          <td>4</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="window.location.href='/mahasiswa/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mahasiswa Budi Santoso')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12346</td>
          <td>Sari Dewi Rahayu</td>
          <td>Teknik Informatika</td>
          <td>2022</td>
          <td>4</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs"
                onclick="window.location.href='/mahasiswa/create'">
                <i class="fas fa-pen"></i>
                </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mahasiswa Sari Dewi')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12347</td>
          <td>Ahmad Fauzi</td>
          <td>Teknik Elektro</td>
          <td>2021</td>
          <td>6</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs"
                onclick="window.location.href='/mahasiswa/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mahasiswa Ahmad Fauzi')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12348</td>
          <td>Rina Wati</td>
          <td>Manajemen Bisnis</td>
          <td>2023</td>
          <td>2</td>
          <td><span class="badge b-warning">Cuti</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs"
                onclick="window.location.href='/mahasiswa/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mahasiswa Rina Wati')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12349</td>
          <td>Dian Pratama</td>
          <td>Teknik Informatika</td>
          <td>2020</td>
          <td>8</td>
          <td><span class="badge b-info">Lulus</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs"
                onclick="window.location.href='/mahasiswa/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mahasiswa Dian Pratama')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <span class="pg-info">Menampilkan 5 dari 1.250 data</span>
    <div class="pg-btns">
      <div class="pg-btn pg-arr">‹</div>
      <div class="pg-btn active">1</div>
      <div class="pg-btn">2</div>
      <div class="pg-btn">3</div>
      <div class="pg-btn pg-arr">›</div>
    </div>
  </div>
</div>
@endsection

<script>

function doDelete() {
  if (currentRow) {
    currentRow.style.transition = "0.3s";
    currentRow.style.opacity = "0";

    setTimeout(() => {
      currentRow.remove();
    }, 300);
  }

  closeModal('mDelete');
}
</script>
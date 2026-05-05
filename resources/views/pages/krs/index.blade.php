{{-- resources/views/pages/krs/index.blade.php --}}
@extends('layouts.app')

@section('title', 'KRS')
@section('page_title', 'KRS')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Pengajuan KRS</h2>
    <p>Kelola dan setujui Kartu Rencana Studi mahasiswa</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

{{-- Tabel Pengajuan --}}
<div class="card" style="margin-bottom:20px">
  <div class="toolbar">
    <div class="t-left">
      <div class="search"><i class="fas fa-search search-ic"></i><input type="text" placeholder="Cari mahasiswa..."></div>
      <select class="t-select">
        <option>Semua Semester</option>
        <option>Ganjil 2024/2025</option>
        <option>Genap 2025/2026</option>
      </select>
      <select class="t-select">
        <option>Semua Status</option>
        <option>Menunggu</option>
        <option>Disetujui</option>
        <option>Ditolak</option>
      </select>
    </div>
  </div>

  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Semester</th>
          <th>Total SKS</th>
          <th>Tgl Pengajuan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="td-strong">12345</td>
          <td>Budi Santoso</td>
          <td>Genap 2025/2026</td>
          <td><strong>20 SKS</strong></td>
          <td>20 Mei 2025</td>
          <td><span class="badge b-warning">Menunggu</span></td>
          <td>
            <button class="btn btn-blue btn-xs" onclick="showKrsDetail('12345','Budi Santoso')">
              <i class="fas fa-eye"></i> Review
            </button>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12346</td>
          <td>Sari Dewi Rahayu</td>
          <td>Genap 2025/2026</td>
          <td><strong>18 SKS</strong></td>
          <td>19 Mei 2025</td>
          <td><span class="badge b-success">Disetujui</span></td>
          <td>
            <button class="btn btn-ghost btn-xs" onclick="showKrsDetail('12346','Sari Dewi Rahayu')">
              <i class="fas fa-eye"></i> Lihat
            </button>
          </td>
        </tr>
        <tr>
          <td class="td-strong">12347</td>
          <td>Ahmad Fauzi</td>
          <td>Genap 2025/2026</td>
          <td><strong>22 SKS</strong></td>
          <td>18 Mei 2025</td>
          <td><span class="badge b-danger">Ditolak</span></td>
          <td>
            <button class="btn btn-ghost btn-xs" onclick="showKrsDetail('12347','Ahmad Fauzi')">
              <i class="fas fa-eye"></i> Lihat
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

{{-- Detail Review Panel --}}
<div id="krsDetail" class="card" style="display:none">
  <div class="card-hd">
    <div>
      <h3>Review Pengajuan KRS</h3>
      <p id="krsDetailSub">Detail mata kuliah yang diajukan</p>
    </div>
    <button class="btn btn-ghost btn-sm" onclick="document.getElementById('krsDetail').style.display='none'">
      <i class="fas fa-times"></i> Tutup
    </button>
  </div>
  <div class="card-bd">
    <div class="alert alert-info">
      <i class="fas fa-info-circle"></i>
      Periksa setiap mata kuliah dan berikan persetujuan atau penolakan secara individual atau sekaligus.
    </div>
    <div class="krs-detail-meta">
      <div class="kdm-item"><span>Mahasiswa</span><strong id="krsNama">—</strong></div>
      <div class="kdm-item"><span>NIM</span><strong id="krsNim">—</strong></div>
      <div class="kdm-item"><span>Semester</span><strong>Genap 2025/2026</strong></div>
      <div class="kdm-item"><span>Program Studi</span><strong>Teknik Informatika</strong></div>
    </div>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Kelas</th>
            <th>Dosen</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td class="td-strong">IF101</td>
            <td>Basis Data</td>
            <td>3</td>
            <td>D</td>
            <td>Dr. Hendra Wijaya</td>
            <td>
              <div style="display:flex;gap:6px">
                <button class="btn btn-success btn-xs"><i class="fas fa-check"></i> Setuju</button>
                <button class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Tolak</button>
              </div>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td class="td-strong">IF102</td>
            <td>Algoritma &amp; Pemrograman</td>
            <td>4</td>
            <td>A</td>
            <td>Dr. Hendra Wijaya</td>
            <td>
              <div style="display:flex;gap:6px">
                <button class="btn btn-success btn-xs"><i class="fas fa-check"></i> Setuju</button>
                <button class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Tolak</button>
              </div>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td class="td-strong">IF203</td>
            <td>Kecerdasan Buatan</td>
            <td>4</td>
            <td>B</td>
            <td>Ir. Siti Aminah, M.T.</td>
            <td>
              <div style="display:flex;gap:6px">
                <button class="btn btn-success btn-xs"><i class="fas fa-check"></i> Setuju</button>
                <button class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Tolak</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="krs-total">
      <div style="display:flex;align-items:center;gap:16px">
        <div style="font-size:13px;color:var(--text-3)">Total SKS Diajukan:</div>
        <div style="font-family:var(--font-head);font-size:22px;font-weight:800;color:var(--navy)">11 SKS</div>
      </div>
      <div style="display:flex;gap:10px">
        <button class="btn btn-ghost btn-sm"><i class="fas fa-comment-alt"></i> Beri Catatan</button>
        <form onsubmit="rejectAll(event)" style="display:inline">
          <input type="hidden" name="nim" id="krsFormNim">
          <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak Semua</button>
        </form>
        <form onsubmit="approveAll(event)" style="display:inline">
          <input type="hidden" name="nim" id="krsFormNim2">
          <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Setujui Semua</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
function rejectAll(e) {
  e.preventDefault();

  alert("Semua KRS berhasil ditolak (DEMO)");

  // contoh efek visual (optional)
  document.querySelectorAll('.badge').forEach(el => {
    el.textContent = "Ditolak";
    el.className = "badge b-danger";
  });
}

function approveAll(e) {
  e.preventDefault();

  alert("Semua KRS berhasil disetujui (DEMO)");

  document.querySelectorAll('.badge').forEach(el => {
    el.textContent = "Disetujui";
    el.className = "badge b-success";
  });
}
</script>
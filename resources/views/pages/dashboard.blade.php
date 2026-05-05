{{-- resources/views/pages/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ auth()->user()->name ?? 'Ema Merlisa' }} — Semester Genap 2025/2026</p>
  </div>
  <button class="btn btn-ghost btn-sm"><i class="fas fa-download"></i> Export Laporan</button>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
  <a href="/mahasiswa" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-blue"><i class="fas fa-user-graduate"></i></div>
    <div>
      <div class="stat-n">1.250</div>
      <div class="stat-l">Mahasiswa Aktif</div>
      <div class="stat-chg chg-up"><i class="fas fa-arrow-up" style="font-size:9px"></i> 3.2% bulan ini</div>
    </div>
  </a>
  <a href="/krs" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-green"><i class="fas fa-check-circle"></i></div>
    <div>
      <div class="stat-n">980</div>
      <div class="stat-l">KRS Disetujui</div>
      <div class="stat-chg chg-up"><i class="fas fa-arrow-up" style="font-size:9px"></i> 78.4% dari total</div>
    </div>
  </a>
  <a href="/khs" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-amber"><i class="fas fa-file-invoice"></i></div>
    <div>
      <div class="stat-n">870</div>
      <div class="stat-l">KHS Terbit</div>
      <div class="stat-chg chg-dn"><i class="fas fa-arrow-down" style="font-size:9px"></i> 2 pending</div>
    </div>
  </a>
  <a href="/matakuliah" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-purple"><i class="fas fa-book-open"></i></div>
    <div>
      <div class="stat-n">48</div>
      <div class="stat-l">Mata Kuliah</div>
      <div class="stat-chg" style="background:#f5f3ff;color:#7c3aed"><i class="fas fa-dot-circle" style="font-size:9px"></i> 5 prodi</div>
    </div>
  </a>
</div>

<div class="dash-grid">
  {{-- Recent KRS --}}
  <div class="card">
    <div class="card-hd">
      <div>
        <h3>Pengajuan KRS Terbaru</h3>
        <p>Menunggu persetujuan administrator</p>
      </div>
      <a href="/krs" class="btn btn-blue btn-sm">
        Lihat Semua <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>SKS</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="td-strong">12345</td>
            <td>Budi Santoso</td>
            <td>Genap 25/26</td>
            <td>20</td>
            <td><span class="badge b-warning">Menunggu</span></td>
          </tr>
          <tr>
            <td class="td-strong">12346</td>
            <td>Sari Dewi Rahayu</td>
            <td>Genap 25/26</td>
            <td>18</td>
            <td><span class="badge b-success">Disetujui</span></td>
          </tr>
          <tr>
            <td class="td-strong">12347</td>
            <td>Ahmad Fauzi</td>
            <td>Genap 25/26</td>
            <td>22</td>
            <td><span class="badge b-warning">Menunggu</span></td>
          </tr>
          <tr>
            <td class="td-strong">12348</td>
            <td>Rina Wati</td>
            <td>Genap 25/26</td>
            <td>16</td>
            <td><span class="badge b-success">Disetujui</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  {{-- Activity --}}
  <div class="card">
    <div class="card-hd"><h3>Aktivitas Terkini</h3></div>
    <div class="card-bd">
      <div class="activity-list">
        <div class="act-item">
          <div class="act-ic" style="background:#ecfdf5;color:var(--success)"><i class="fas fa-check"></i></div>
          <div><div class="act-txt">KRS Budi Santoso disetujui</div><div class="act-time"><i class="far fa-clock" style="margin-right:4px"></i>2 menit lalu</div></div>
        </div>
        <div class="act-item">
          <div class="act-ic" style="background:#eff6ff;color:var(--blue)"><i class="fas fa-plus"></i></div>
          <div><div class="act-txt">Mahasiswa baru ditambahkan</div><div class="act-time"><i class="far fa-clock" style="margin-right:4px"></i>15 menit lalu</div></div>
        </div>
        <div class="act-item">
          <div class="act-ic" style="background:#fffbeb;color:var(--warning)"><i class="fas fa-pen"></i></div>
          <div><div class="act-txt">Nilai IF101 diperbarui</div><div class="act-time"><i class="far fa-clock" style="margin-right:4px"></i>1 jam lalu</div></div>
        </div>
        <div class="act-item">
          <div class="act-ic" style="background:#fef2f2;color:var(--danger)"><i class="fas fa-times"></i></div>
          <div><div class="act-txt">KRS Ahmad Fauzi ditolak</div><div class="act-time"><i class="far fa-clock" style="margin-right:4px"></i>3 jam lalu</div></div>
        </div>
        <div class="act-item">
          <div class="act-ic" style="background:#f5f3ff;color:#7c3aed"><i class="fas fa-user"></i></div>
          <div><div class="act-txt">Dosen baru didaftarkan</div><div class="act-time"><i class="far fa-clock" style="margin-right:4px"></i>5 jam lalu</div></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ auth()->user()->name }} - Semester Genap 2025/2026</p>
  </div>
</div>

<div class="stat-grid">
  <a href="{{ route('mahasiswa.index') }}" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-blue"><i class="fas fa-user-graduate"></i></div>
    <div><div class="stat-n">{{ $studentCount }}</div><div class="stat-l">Mahasiswa Aktif</div></div>
  </a>
  <a href="{{ route('krs.index') }}" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-green"><i class="fas fa-check-circle"></i></div>
    <div><div class="stat-n">{{ $approvedKrsCount }}</div><div class="stat-l">KRS Disetujui · {{ $pendingKrsCount }} Pending</div></div>
  </a>
  <a href="{{ route('khs.index') }}" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-amber"><i class="fas fa-file-invoice"></i></div>
    <div><div class="stat-n">{{ $gradedKrsCount }}</div><div class="stat-l">KHS Terbit</div></div>
  </a>
  <a href="{{ route('matakuliah.index') }}" class="stat" style="text-decoration:none">
    <div class="stat-ic ic-purple"><i class="fas fa-book-open"></i></div>
    <div><div class="stat-n">{{ $courseCount }}</div><div class="stat-l">Mata Kuliah</div></div>
  </a>
</div>

<div class="card">
  <div class="card-hd"><h3>Aktivitas KRS Terbaru</h3></div>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>Mahasiswa</th>
          <th>Mata Kuliah</th>
          <th>Status</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentKrs as $item)
          <tr>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->course->code }} - {{ $item->course->name }}</td>
            <td>
              <span class="badge {{ $item->status === 'approved' ? 'b-success' : ($item->status === 'pending' ? 'b-warning' : 'b-danger') }}">
                {{ $item->status === 'approved' ? 'Disetujui' : ($item->status === 'pending' ? 'Pending' : 'Ditolak') }}
              </span>
            </td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="4" style="text-align:center">Belum ada aktivitas.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'KRS')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Pengajuan KRS</h2>
    <p>Rekap pengajuan mata kuliah mahasiswa yang menunggu persetujuan admin</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert alert-warn"><i class="fas fa-exclamation-circle"></i>{{ $errors->first() }}</div>
@endif

<div class="stat-grid">
  <div class="stat">
    <div class="stat-ic ic-amber"><i class="fas fa-clock"></i></div>
    <div><div class="stat-n">{{ $pendingKrsCount }}</div><div class="stat-l">Menunggu Persetujuan</div></div>
  </div>
  <div class="stat">
    <div class="stat-ic ic-blue"><i class="fas fa-layer-group"></i></div>
    <div><div class="stat-n">{{ $krsByStudent->count() }}</div><div class="stat-l">Kelompok Pengajuan</div></div>
  </div>
</div>

<div class="card">
  <div class="card-hd">
    <div>
      <h3>Data KRS Mahasiswa</h3>
      <p>Batas standar {{ $maxCredits }} SKS per semester</p>
    </div>
  </div>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Tahun Akademik</th>
          <th>Total MK</th>
          <th>Total SKS</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($krsByStudent as $studentKrs)
          @php
            $first = $studentKrs->first();
            $student = $first->student;
            $credits = $studentKrs->sum(fn($item) => $item->course->credits ?? 0);
            $pending = $studentKrs->where('status', 'pending')->count();
            $approved = $studentKrs->where('status', 'approved')->count();
            $rejected = $studentKrs->where('status', 'rejected')->count();
          @endphp
          <tr>
            <td class="td-strong">{{ $student->nim }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $first->academic_year }} / {{ ucfirst($first->semester_type) }}</td>
            <td>{{ $studentKrs->count() }}</td>
            <td>{{ $credits }} SKS</td>
            <td>
              @if($pending)
                <span class="badge b-warning">{{ $pending }} pending</span>
              @elseif($rejected && ! $approved)
                <span class="badge b-danger">Ditolak</span>
              @else
                <span class="badge b-success">Selesai</span>
              @endif
              <div style="font-size:11px;color:var(--text-3);margin-top:5px">
                {{ $approved }} disetujui · {{ $rejected }} ditolak
              </div>
            </td>
            <td>
              <a href="{{ route('krs.detail', $student) }}" class="btn btn-blue btn-xs"><i class="fas fa-eye"></i> Detail</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center">Belum ada data KRS.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

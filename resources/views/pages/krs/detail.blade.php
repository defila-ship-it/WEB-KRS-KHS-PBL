@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Detail KRS</h2>
    <p>{{ $student->nim }} - {{ $student->name }}</p>
  </div>
  <a href="{{ route('krs.index') }}" class="btn btn-ghost btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert alert-warn"><i class="fas fa-exclamation-circle"></i>{{ $errors->first() }}</div>
@endif

<div class="card">
  <div class="card-bd">
    <div class="krs-detail-meta">
      <div class="kdm-item"><span>Program Studi</span><strong>{{ $student->study_program }}</strong></div>
      <div class="kdm-item"><span>Semester</span><strong>{{ $student->semester }}</strong></div>
      <div class="kdm-item"><span>Total SKS</span><strong>{{ $krs->sum(fn($item) => $item->course->credits ?? 0) }} / {{ $maxCredits }}</strong></div>
      <div class="kdm-item"><span>Tahun Akademik</span><strong>{{ $student->academic_year }}</strong></div>
    </div>
  </div>
</div>

<div class="stat-grid">
  <div class="stat"><div class="stat-ic ic-amber"><i class="fas fa-clock"></i></div><div><div class="stat-n">{{ $pendingCount }}</div><div class="stat-l">Pending</div></div></div>
  <div class="stat"><div class="stat-ic ic-green"><i class="fas fa-check"></i></div><div><div class="stat-n">{{ $approvedCount }}</div><div class="stat-l">Disetujui</div></div></div>
  <div class="stat"><div class="stat-ic" style="background:#fef2f2;color:#dc2626"><i class="fas fa-times"></i></div><div><div class="stat-n">{{ $rejectedCount }}</div><div class="stat-l">Ditolak</div></div></div>
</div>

<div class="card">
  <div class="card-hd">
    <div>
      <h3>Daftar Pengajuan KRS</h3>
      <p>Admin menyetujui atau menolak mata kuliah yang diajukan mahasiswa</p>
    </div>
    @if($pendingCount)
      <div style="display:flex;gap:8px;flex-wrap:wrap">
        <form method="POST" action="{{ route('krs.status.bulk') }}">
          @csrf
          @method('PUT')
          <input type="hidden" name="status" value="approved">
          @foreach($krs->where('status', 'pending') as $pendingItem)
            <input type="hidden" name="krs_ids[]" value="{{ $pendingItem->id }}">
          @endforeach
          <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-check"></i> Setujui Semua Pending</button>
        </form>
        <form method="POST" action="{{ route('krs.status.bulk') }}">
          @csrf
          @method('PUT')
          <input type="hidden" name="status" value="rejected">
          @foreach($krs->where('status', 'pending') as $pendingItem)
            <input type="hidden" name="krs_ids[]" value="{{ $pendingItem->id }}">
          @endforeach
          <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-times"></i> Tolak Semua Pending</button>
        </form>
      </div>
    @endif
  </div>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>Kode MK</th>
          <th>Mata Kuliah</th>
          <th>SKS</th>
          <th>Dosen</th>
          <th>Status</th>
          <th>Diproses Oleh</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($krs as $item)
          <tr>
            <td class="td-strong">{{ $item->course->code }}</td>
            <td>{{ $item->course->name }}</td>
            <td>{{ $item->course->credits }}</td>
            <td>{{ $item->course->lecturer->name ?? '-' }}</td>
            <td><span class="badge {{ $item->status === 'approved' ? 'b-success' : ($item->status === 'pending' ? 'b-warning' : 'b-danger') }}">{{ ucfirst($item->status) }}</span></td>
            <td>
              @if($item->approved_by)
                {{ $item->approver->name ?? '-' }}
                <div style="font-size:11px;color:var(--text-3)">{{ $item->approved_at?->format('d M Y H:i') }}</div>
              @else
                <span style="color:var(--text-3)">Belum diproses</span>
              @endif
            </td>
            <td>
              @if($item->status === 'pending')
                <div style="display:flex;gap:6px">
                  <form method="POST" action="{{ route('krs.status', $item) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button class="btn btn-success btn-xs" type="submit">Setujui</button>
                  </form>
                  <form method="POST" action="{{ route('krs.status', $item) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected">
                    <button class="btn btn-danger btn-xs" type="submit">Tolak</button>
                  </form>
                </div>
              @else
                -
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center">Mahasiswa belum mengajukan KRS.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

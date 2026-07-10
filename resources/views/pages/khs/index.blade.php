@extends('layouts.app')

@section('title', 'KHS')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>KHS Mahasiswa</h2>
    <p>Rekap kartu hasil studi dari nilai yang sudah diinput dosen</p>
  </div>
</div>

<div class="card">
  <div class="card-hd">
    <div>
      <h3>Data Nilai Mahasiswa</h3>
      <p>Grade dihitung otomatis dari nilai angka 0-100</p>
    </div>
  </div>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Mata Kuliah</th>
          <th>Dosen</th>
          <th>Nilai</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody>
        @forelse($krs as $item)
          <tr>
            <td class="td-strong">{{ $item->student->nim }}</td>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->course->code }} - {{ $item->course->name }}</td>
            <td>{{ $item->course->lecturer->name ?? '-' }}</td>
            <td>{{ $item->grade ?? '-' }}</td>
            <td><span class="badge {{ $item->grade ? 'b-info' : 'b-gray' }}">{{ $item->grade_letter }}</span></td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center">Belum ada nilai.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

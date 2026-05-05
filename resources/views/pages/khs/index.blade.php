{{-- resources/views/pages/khs/index.blade.php --}}
@extends('layouts.app')

@section('title', 'KHS')
@section('page_title', 'KHS')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Input Nilai &amp; KHS</h2>
    <p>Penginputan nilai dan penerbitan Kartu Hasil Studi</p>
  </div>
  <button class="btn btn-success btn-sm" onclick="simpanSemuaNilai()">
    <i class="fas fa-save"></i> Simpan Semua Nilai
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-hd">
    <div>
      <h3>Input Nilai Mata Kuliah</h3>
      <p>Masukkan nilai tugas, UTS, dan UAS untuk setiap mahasiswa</p>
    </div>
  </div>

  <div class="toolbar" style="border-top:none">
    <div class="t-left">
      <select class="t-select" style="min-width:260px" id="selectMK" onchange="loadNilai()">
        <option value="IF101-D">IF101 — Basis Data (Kelas D)</option>
        <option value="IF102-A">IF102 — Algoritma &amp; Pemrograman (Kelas A)</option>
        <option value="EL201-B">EL201 — Rangkaian Listrik (Kelas B)</option>
      </select>
      <select class="t-select" id="selectSemester">
        <option>Genap 2025/2026</option>
        <option>Ganjil 2024/2025</option>
      </select>
    </div>
    <div style="display:flex;align-items:center;gap:8px">
      <button class="btn btn-ghost btn-sm"><i class="fas fa-upload"></i> Import CSV</button>
      <form onsubmit="saveNilai(event)" id="nilaiForm" novalidate>
        <button type="submit" class="btn btn-blue btn-sm"><i class="fas fa-save"></i> Simpan Nilai</button>
      </form>
    </div>
  </div>

  <div class="alert alert-warn" style="margin:0 22px 16px">
    <i class="fas fa-exclamation-triangle"></i>
    Formula: Nilai Akhir = (Tugas × 30%) + (UTS × 30%) + (UAS × 40%). Isi semua kolom sebelum menyimpan.
  </div>

  <div class="tbl-wrap">
    <table id="nilaiTable">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Tugas (30%)</th>
          <th>UTS (30%)</th>
          <th>UAS (40%)</th>
          <th>Nilai Akhir</th>
          <th>Huruf</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td class="td-strong">12345</td>
          <td>Budi Santoso</td>
          <td><input type="number" class="nilai-input" name="tugas[]" value="80" min="0" max="100" oninput="hitungNilai(this, 1)"></td>
          <td><input type="number" class="nilai-input" name="uts[]"   value="75" min="0" max="100" oninput="hitungNilai(this, 1)"></td>
          <td><input type="number" class="nilai-input" name="uas[]"   value="85" min="0" max="100" oninput="hitungNilai(this, 1)"></td>
          <td><strong id="akhir-1" style="color:var(--navy);font-family:var(--font-head)">80.5</strong></td>
          <td>
            <select class="grade-select" name="huruf[]" id="huruf-1">
              <option>A</option>
              <option selected>AB</option>
              <option>B</option>
              <option>BC</option>
              <option>C</option>
              <option>D</option>
              <option>E</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td class="td-strong">12346</td>
          <td>Sari Dewi Rahayu</td>
          <td><input type="number" class="nilai-input" name="tugas[]" value="90" min="0" max="100" oninput="hitungNilai(this, 2)"></td>
          <td><input type="number" class="nilai-input" name="uts[]"   value="88" min="0" max="100" oninput="hitungNilai(this, 2)"></td>
          <td><input type="number" class="nilai-input" name="uas[]"   value="92" min="0" max="100" oninput="hitungNilai(this, 2)"></td>
          <td><strong id="akhir-2" style="color:var(--success);font-family:var(--font-head)">90.2</strong></td>
          <td>
            <select class="grade-select" name="huruf[]" id="huruf-2">
              <option selected>A</option>
              <option>AB</option>
              <option>B</option>
              <option>BC</option>
              <option>C</option>
              <option>D</option>
              <option>E</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td class="td-strong">12347</td>
          <td>Ahmad Fauzi</td>
          <td><input type="number" class="nilai-input" name="tugas[]" value="70" min="0" max="100" oninput="hitungNilai(this, 3)"></td>
          <td><input type="number" class="nilai-input" name="uts[]"   value="65" min="0" max="100" oninput="hitungNilai(this, 3)"></td>
          <td><input type="number" class="nilai-input" name="uas[]"   value="72" min="0" max="100" oninput="hitungNilai(this, 3)"></td>
          <td><strong id="akhir-3" style="color:var(--warning);font-family:var(--font-head)">69.3</strong></td>
          <td>
            <select class="grade-select" name="huruf[]" id="huruf-3">
              <option>A</option>
              <option>AB</option>
              <option selected>B</option>
              <option>BC</option>
              <option>C</option>
              <option>D</option>
              <option>E</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="padding:16px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:8px">
    <span style="font-size:12px;color:var(--text-3);align-self:center">3 mahasiswa terdaftar</span>
  </div>
</div>
@endsection

<script>
function hitungNilai(input, row) {
  const tr = input.closest('tr');
  const inputs = tr.querySelectorAll('.nilai-input');
  const tugas = parseFloat(inputs[0].value) || 0;
  const uts   = parseFloat(inputs[1].value) || 0;
  const uas   = parseFloat(inputs[2].value) || 0;
  const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
  const el    = document.getElementById(`akhir-${row}`);
  el.textContent = akhir.toFixed(1);

  // auto-grade
  const grade = akhir >= 85 ? 'A' : akhir >= 80 ? 'AB' : akhir >= 75 ? 'B' : akhir >= 70 ? 'BC' : akhir >= 60 ? 'C' : akhir >= 50 ? 'D' : 'E';
  el.style.color = akhir >= 80 ? 'var(--success)' : akhir >= 65 ? 'var(--warning)' : 'var(--danger)';
  const hurufEl = document.getElementById(`huruf-${row}`);
  if (hurufEl) hurufEl.value = grade;
}

function simpanSemuaNilai() {
  document.getElementById('nilaiForm').submit();
}
</script>
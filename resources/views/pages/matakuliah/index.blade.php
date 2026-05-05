{{-- resources/views/pages/matakuliah/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mata Kuliah')
@section('page_title', 'Mata Kuliah')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Mata Kuliah</h2>
    <p>Manajemen data mata kuliah seluruh program studi</p>
  </div>
  <button class="btn btn-primary btn-sm" onclick="openModal('mMK')">
    <i class="fas fa-plus"></i> Tambah MK
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="card">
  <div class="toolbar">
    <div class="t-left">
      <div class="search">
        <i class="fas fa-search search-ic"></i>
        <input type="text" placeholder="Cari mata kuliah..." id="searchInput" oninput="filterTable()">
      </div>
      <select class="t-select" id="filterSemester" onchange="filterTable()">
        <option value="">Semua Semester</option>
        <option value="Ganjil">Ganjil</option>
        <option value="Genap">Genap</option>
      </select>
      <select class="t-select" id="filterProdi" onchange="filterTable()">
        <option value="">Semua Prodi</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Teknik Elektro">Teknik Elektro</option>
        <option value="Manajemen Bisnis">Manajemen Bisnis</option>
      </select>
    </div>
    <span style="font-size:12px;color:var(--text-3)">48 mata kuliah</span>
  </div>

  <div class="tbl-wrap">
    <table id="mkTable">
      <thead>
        <tr>
          <th>Kode MK</th>
          <th>Nama Mata Kuliah</th>
          <th>SKS</th>
          <th>Semester</th>
          <th>Program Studi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="td-strong">IF101</td>
          <td>Basis Data</td>
          <td>3</td>
          <td>Genap</td>
          <td>Teknik Informatika</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
                <button class="btn btn-warning btn-xs"
                onclick="openEditMK('IF101','Basis Data','3','Genap','Teknik Informatika')">
                <i class="fas fa-pen"></i>
                </button>

                <button class="btn btn-danger btn-xs"
                onclick="confirmDelete('Mata Kuliah IF101')">
                <i class="fas fa-trash"></i>
                </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">IF102</td>
          <td>Algoritma &amp; Pemrograman</td>
          <td>4</td>
          <td>Ganjil</td>
          <td>Teknik Informatika</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="openEditMK('IF102','Algoritma & Pemrograman','4','Ganjil','Teknik Informatika')">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mata Kuliah IF102')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">EL201</td>
          <td>Rangkaian Listrik</td>
          <td>3</td>
          <td>Ganjil</td>
          <td>Teknik Elektro</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="openEditMK('EL201','Rangkaian Listrik','3','Ganjil','Teknik Elektro')">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mata Kuliah EL201')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">MB301</td>
          <td>Manajemen Keuangan</td>
          <td>3</td>
          <td>Genap</td>
          <td>Manajemen Bisnis</td>
          <td><span class="badge b-gray">Tidak Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="openEditMK('MB301','Manajemen Keuangan','3','Genap','Manajemen Bisnis')">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mata Kuliah MB301')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">IF203</td>
          <td>Kecerdasan Buatan</td>
          <td>4</td>
          <td>Genap</td>
          <td>Teknik Informatika</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="openEditMK('IF203','Kecerdasan Buatan','4','Genap','Teknik Informatika')">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Mata Kuliah IF203')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <span class="pg-info">Menampilkan 5 dari 48 data</span>
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

@push('modals')
{{-- Tambah Mata Kuliah --}}
<div id="mMK" class="overlay">
  <div class="modal">
    <div class="modal-hd">
      <h4><i class="fas fa-plus-circle" style="color:var(--blue);margin-right:8px"></i>Tambah Mata Kuliah</h4>
      <div class="modal-x" onclick="closeModal('mMK')"><i class="fas fa-times"></i></div>
    </div>
    <form onsubmit="saveMK(event)" novalidate>
      <div class="modal-bd">
        <div class="f-grid f-grid-2">
          <div><label class="f-lbl">Kode MK</label><input class="f-ctrl" name="kode" placeholder="Contoh: IF101" required></div>
          <div><label class="f-lbl">Nama Mata Kuliah</label><input class="f-ctrl" name="nama" placeholder="Nama mata kuliah" required></div>
          <div>
            <label class="f-lbl">SKS</label>
            <select class="f-sel" name="sks">
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div>
            <label class="f-lbl">Semester</label>
            <select class="f-sel" name="semester">
              <option value="Ganjil">Ganjil</option>
              <option value="Genap">Genap</option>
            </select>
          </div>
          <div style="grid-column:1/-1">
            <label class="f-lbl">Program Studi</label>
            <select class="f-sel" name="prodi">
              <option value="Teknik Informatika">Teknik Informatika</option>
              <option value="Teknik Elektro">Teknik Elektro</option>
              <option value="Manajemen Bisnis">Manajemen Bisnis</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('mMK')">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Edit Mata Kuliah --}}
<div id="eMK" class="overlay">
  <div class="modal">
    <div class="modal-hd">
      <h4><i class="fas fa-pen" style="color:orange;margin-right:8px"></i>Edit Mata Kuliah</h4>
      <div class="modal-x" onclick="closeModal('eMK')"><i class="fas fa-times"></i></div>
    </div>

    <form onsubmit="saveEditMK(event)" novalidate>
      <div class="modal-bd">
        <div class="f-grid f-grid-2">

          <div>
            <label class="f-lbl">Kode MK</label>
            <input class="f-ctrl" id="editKode">
          </div>

          <div>
            <label class="f-lbl">Nama Mata Kuliah</label>
            <input class="f-ctrl" id="editNama">
          </div>

          <div>
            <label class="f-lbl">SKS</label>
            <select class="f-sel" id="editSks">
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </div>

          <div>
            <label class="f-lbl">Semester</label>
            <select class="f-sel" id="editSemester">
              <option>Ganjil</option>
              <option>Genap</option>
            </select>
          </div>

          <div style="grid-column:1/-1">
            <label class="f-lbl">Program Studi</label>
            <select class="f-sel" id="editProdi">
              <option>Teknik Informatika</option>
              <option>Teknik Elektro</option>
              <option>Manajemen Bisnis</option>
            </select>
          </div>

        </div>
      </div>

      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('eMK')">Batal</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> Simpan
        </button>
      </div>
    </form>

  </div>
</div>
@endpush

<script>
function openEditMK(kode, nama, sks, semester, prodi) {
  document.getElementById('editKode').value     = kode;
  document.getElementById('editNama').value     = nama;
  document.getElementById('editSks').value      = sks;
  document.getElementById('editSemester').value = semester;
  document.getElementById('editProdi').value    = prodi;

  openModal('eMK');
}

function saveEditMK(e) {
  e.preventDefault();

  const data = {
    kode: document.getElementById('editKode').value,
    nama: document.getElementById('editNama').value,
    sks: document.getElementById('editSks').value,
    semester: document.getElementById('editSemester').value,
    prodi: document.getElementById('editProdi').value
  };

  alert(
    "Data berhasil diupdate (DEMO)\n\n" +
    "Kode: " + data.kode + "\n" +
    "Nama: " + data.nama + "\n" +
    "SKS: " + data.sks + "\n" +
    "Semester: " + data.semester + "\n" +
    "Prodi: " + data.prodi
  );

  closeModal('eMK');
}

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
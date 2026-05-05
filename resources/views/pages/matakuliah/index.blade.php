{{-- resources/views/pages/matakuliah/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mata Kuliah')
@section('page_title', 'Mata Kuliah')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="page-simple">

  <div class="page-head">
    <h2>Mata Kuliah</h2>
    <button class="btn-add" onclick="openModal('mMK')">
      + Tambah
    </button>
  </div>

  <div class="table-box">
    <table>
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama</th>
          <th>SKS</th>
          <th>Semester</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>IF101</td>
          <td>Basis Data</td>
          <td>3</td>
          <td>Genap</td>
          <td>
            <button onclick="openEditMK('IF101','Basis Data','3','Genap','TI')">Edit</button>
            <button onclick="confirmDelete('IF101')">Hapus</button>
          </td>
        </tr>

        <tr>
          <td>IF102</td>
          <td>Algoritma</td>
          <td>4</td>
          <td>Ganjil</td>
          <td>
            <button onclick="openEditMK('IF102','Algoritma','4','Ganjil','TI')">Edit</button>
            <button onclick="confirmDelete('IF102')">Hapus</button>
          </td>
        </tr>

      </tbody>
    </table>
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
{{-- resources/views/pages/dosen/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Dosen')
@section('page_title', 'Dosen')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Dosen</h2>
    <p>Manajemen data dosen pengampu mata kuliah</p>
  </div>
  <button class="btn btn-add btn-sm" onclick="window.location.href='/dosen/create'">
     <i class="fas fa-plus"></i> Tambah Dosen
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="card">
  <div class="toolbar">
    <div class="t-left">
      <div class="search"><i class="fas fa-search search-ic"></i><input type="text" placeholder="Cari dosen..."></div>
      <select class="t-select">
        <option>Semua Prodi</option>
        <option>Teknik Informatika</option>
        <option>Teknik Elektro</option>
        <option>Manajemen Bisnis</option>
      </select>
      <select class="t-select">
        <option>Semua Jabatan</option>
        <option>Asisten Ahli</option>
        <option>Lektor</option>
        <option>Lektor Kepala</option>
        <option>Profesor</option>
      </select>
    </div>
  </div>

  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>NIDN</th>
          <th>Nama Dosen</th>
          <th>Email</th>
          <th>Jabatan</th>
          <th>Program Studi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="td-strong">001234</td>
          <td>Dr. Hendra Wijaya</td>
          <td>hendra@polibatam.ac.id</td>
          <td>Lektor Kepala</td>
          <td>Teknik Informatika</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="window.location.href='/dosen/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Dosen Dr. Hendra Wijaya')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">001235</td>
          <td>Ir. Siti Aminah, M.T.</td>
          <td>siti@polibatam.ac.id</td>
          <td>Lektor</td>
          <td>Teknik Elektro</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="window.location.href='/dosen/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Dosen Ir. Siti Aminah')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="td-strong">001236</td>
          <td>Dr. Rudi Hartono</td>
          <td>rudi@polibatam.ac.id</td>
          <td>Asisten Ahli</td>
          <td>Manajemen Bisnis</td>
          <td><span class="badge b-success">Aktif</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <button class="btn btn-warning btn-xs" onclick="window.location.href='/dosen/create'">
                <i class="fas fa-pen"></i>
              </button>
              <button class="btn btn-danger btn-xs" onclick="confirmDelete('Dosen Dr. Rudi Hartono')"><i class="fas fa-trash"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <span class="pg-info">Menampilkan 3 dari 87 data</span>
    <div class="pg-btns">
      <div class="pg-btn pg-arr">‹</div>
      <div class="pg-btn active">1</div>
      <div class="pg-btn">2</div>
      <div class="pg-btn pg-arr">›</div>
    </div>
  </div>
</div>
@endsection

{{-- Tambah Dosen --}}
<div id="mDosen" class="overlay">
  <div class="modal">
    <div class="modal-hd">
      <h4><i class="fas fa-chalkboard-teacher" style="color:var(--blue);margin-right:8px"></i>Tambah Dosen</h4>
      <div class="modal-x" onclick="closeModal('mDosen')"><i class="fas fa-times"></i></div>
    </div>
    <form onsubmit="saveDosen(event)" novalidate>
      <div class="modal-bd">
        <div class="f-grid f-grid-2">
          <div><label class="f-lbl">NIDN</label><input class="f-ctrl" name="nidn" placeholder="Nomor Induk Dosen" required></div>
          <div><label class="f-lbl">Nama Lengkap</label><input class="f-ctrl" name="nama" placeholder="Nama lengkap dosen" required></div>
          <div>
            <label class="f-lbl">Program Studi</label>
            <select class="f-sel" name="prodi">
              <option>Teknik Informatika</option>
              <option>Teknik Elektro</option>
              <option>Manajemen Bisnis</option>
            </select>
          </div>
          <div>
            <label class="f-lbl">Jabatan</label>
            <select class="f-sel" name="jabatan">
              <option>Asisten Ahli</option>
              <option>Lektor</option>
              <option>Lektor Kepala</option>
              <option>Profesor</option>
            </select>
          </div>
          <div style="grid-column:1/-1">
            <label class="f-lbl">Email</label>
            <input class="f-ctrl" type="email" name="email" placeholder="email@polibatam.ac.id" required>
          </div>
        </div>
      </div>
      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('mDosen')">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Edit Dosen --}}
<div id="eDosen" class="overlay">
  <div class="modal">
    <div class="modal-hd">
      <h4><i class="fas fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Dosen</h4>
      <div class="modal-x" onclick="closeModal('eDosen')"><i class="fas fa-times"></i></div>
    </div>
    <form onsubmit="saveEditDosen(event)" novalidate>
      <div class="modal-bd">
        <div class="f-grid f-grid-2">
          <div><label class="f-lbl">NIDN</label><input class="f-ctrl" id="editNidn" name="nidn" required></div>
          <div><label class="f-lbl">Nama Lengkap</label><input class="f-ctrl" id="editDosenNama" name="nama" required></div>
          <div>
            <label class="f-lbl">Program Studi</label>
            <select class="f-sel" id="editDosenProdi" name="prodi">
              <option>Teknik Informatika</option>
              <option>Teknik Elektro</option>
              <option>Manajemen Bisnis</option>
            </select>
          </div>
          <div>
            <label class="f-lbl">Jabatan</label>
            <select class="f-sel" id="editDosenJabatan" name="jabatan">
              <option>Asisten Ahli</option>
              <option>Lektor</option>
              <option>Lektor Kepala</option>
              <option>Profesor</option>
            </select>
          </div>
          <div style="grid-column:1/-1">
            <label class="f-lbl">Email</label>
            <input class="f-ctrl" type="email" id="editDosenEmail" name="email" required>
          </div>
        </div>
      </div>
      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('eDosen')">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function saveDosen(e) {
  e.preventDefault();

  const data = {
    nidn: document.getElementById('nidn').value,
    nama: document.getElementById('namaDosen').value,
    prodi: document.getElementById('prodiDosen').value,
    jabatan: document.getElementById('jabatanDosen').value,
    email: document.getElementById('emailDosen').value
  };

  alert(
    "Dosen berhasil ditambahkan (DEMO)\n\n" +
    "NIDN: " + data.nidn + "\n" +
    "Nama: " + data.nama
  );

  closeModal('mDosen');
}

function openEditDosen(nidn, nama, prodi, jabatan, email) {
  document.getElementById('editNidn').value         = nidn;
  document.getElementById('editDosenNama').value    = nama;
  document.getElementById('editDosenProdi').value   = prodi;
  document.getElementById('editDosenJabatan').value = jabatan;
  document.getElementById('editDosenEmail').value   = email;

  openModal('eDosen');
}

function saveEditDosen(e) {
  e.preventDefault();

  alert("Data dosen berhasil diupdate (DEMO)");

  closeModal('eDosen');
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
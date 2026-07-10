@extends('layouts.app')

@section('title', 'Mata Kuliah')
@section('page_title', 'Mata Kuliah')

@section('content')
<div class="ph">
  <div class="ph-text">
    <h2>Mata Kuliah</h2>
    <p>Manajemen data mata kuliah seluruh program studi</p>
  </div>
  <button class="btn btn-primary btn-sm" onclick="openModal('mCourseAdd')">
    <i class="fas fa-plus"></i> Tambah MK
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert alert-warn"><i class="fas fa-exclamation-circle"></i>{{ $errors->first() }}</div>
@endif

<div class="card">
  <form class="toolbar" method="GET" action="{{ route('matakuliah.index') }}">
    <div class="t-left">
      <div class="search">
        <i class="fas fa-search search-ic"></i>
        <input type="text" name="search" placeholder="Cari mata kuliah..." value="{{ request('search') }}">
      </div>
      <select class="t-select" name="semester_type" onchange="this.form.submit()">
        <option value="">Semua Semester</option>
        <option value="ganjil" @selected(request('semester_type') === 'ganjil')>Ganjil</option>
        <option value="genap" @selected(request('semester_type') === 'genap')>Genap</option>
      </select>
      <select class="t-select" name="study_program" onchange="this.form.submit()">
        <option value="">Semua Prodi</option>
        @foreach($programs as $program)
          <option value="{{ $program }}" @selected(request('study_program') === $program)>{{ $program }}</option>
        @endforeach
      </select>
      <button class="btn btn-ghost btn-sm" type="submit"><i class="fas fa-filter"></i> Filter</button>
    </div>
    <span style="font-size:12px;color:var(--text-3)">{{ $courses->total() }} mata kuliah</span>
  </form>

  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>Kode MK</th>
          <th>Nama Mata Kuliah</th>
          <th>SKS</th>
          <th>Semester</th>
          <th>Program Studi</th>
          <th>Dosen</th>
          <th>Mahasiswa Diajar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($courses as $course)
          <tr>
            <td class="td-strong">{{ $course->code }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->credits }}</td>
            <td>{{ ucfirst($course->semester_type) }} / {{ $course->semester }}</td>
            <td>{{ $course->study_program }}</td>
            <td>{{ $course->lecturer->name ?? '-' }}</td>
            <td>{{ $course->krs_count }} mahasiswa</td>
            <td>
              <div style="display:flex;gap:6px">
                <button class="btn btn-blue btn-xs" type="button" onclick="openModal('mCourseStudents{{ $course->id }}')">
                  <i class="fas fa-users"></i>
                </button>
                <button class="btn btn-warning btn-xs" type="button" onclick="openModal('mCourseEdit{{ $course->id }}')">
                  <i class="fas fa-pen"></i>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="8" style="text-align:center">Tidak ada data mata kuliah.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <span class="pg-info">Menampilkan {{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }} dari {{ $courses->total() }} data</span>
    <div>{{ $courses->links() }}</div>
  </div>
</div>

<div id="mCourseAdd" class="overlay">
  <div class="modal">
    <div class="modal-hd">
      <h4>Tambah Mata Kuliah</h4>
      <div class="modal-x" onclick="closeModal('mCourseAdd')"><i class="fas fa-times"></i></div>
    </div>
    <form method="POST" action="{{ route('matakuliah.store') }}">
      @csrf
      <div class="modal-bd">
        @include('pages.matakuliah._form', ['course' => null])
      </div>
      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('mCourseAdd')">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@foreach($courses as $course)
  @php
    $assignedKrs = $course->krs->where('status', 'approved')->values();
    $assignedStudentIds = $assignedKrs->pluck('student_id');
    $availableStudents = $students
      ->where('study_program', $course->study_program)
      ->reject(fn($student) => $assignedStudentIds->contains($student->id))
      ->values();
  @endphp
  <div id="mCourseStudents{{ $course->id }}" class="overlay">
    <div class="modal">
      <div class="modal-hd">
        <h4>Atur Mahasiswa - {{ $course->code }}</h4>
        <div class="modal-x" onclick="closeModal('mCourseStudents{{ $course->id }}')"><i class="fas fa-times"></i></div>
      </div>
      <div class="modal-bd">
        <div style="margin-bottom:16px">
          <div style="font-weight:700;color:var(--text);margin-bottom:4px">{{ $course->name }}</div>
          <div style="font-size:12px;color:var(--text-3)">
            Dosen: {{ $course->lecturer->name ?? '-' }} · {{ $course->study_program }} · {{ ucfirst($course->semester_type) }} / {{ $course->semester }}
          </div>
        </div>

        <form method="POST" action="{{ route('matakuliah.mahasiswa.store', $course) }}" class="f-grid f-grid-2" style="margin-bottom:18px">
          @csrf
          <div>
            <label class="f-lbl">Tambah Mahasiswa</label>
            <select class="f-sel" name="student_id" required>
              <option value="">Pilih mahasiswa</option>
              @foreach($availableStudents as $student)
                <option value="{{ $student->id }}">{{ $student->nim }} - {{ $student->name }} (Semester {{ $student->semester }})</option>
              @endforeach
            </select>
            <div class="f-help">Mahasiswa yang ditambahkan akan langsung masuk KRS approved untuk mata kuliah ini.</div>
          </div>
          <div style="display:flex;align-items:end">
            <button class="btn btn-primary" type="submit" @disabled($availableStudents->isEmpty())>
              <i class="fas fa-user-plus"></i> Tambahkan
            </button>
          </div>
        </form>

        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Tahun Akademik</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($assignedKrs as $item)
                <tr>
                  <td class="td-strong">{{ $item->student->nim }}</td>
                  <td>{{ $item->student->name }}</td>
                  <td>{{ $item->academic_year }} / {{ ucfirst($item->semester_type) }}</td>
                  <td><span class="badge b-success">Aktif</span></td>
                  <td>
                    @if($item->grade === null)
                      <form method="POST" action="{{ route('matakuliah.mahasiswa.destroy', [$course, $item]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-xs" type="submit"><i class="fas fa-user-minus"></i> Lepas</button>
                      </form>
                    @else
                      <span style="font-size:12px;color:var(--text-3)">Sudah dinilai</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" style="text-align:center">Belum ada mahasiswa di mata kuliah ini.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-ft">
        <button type="button" class="btn btn-ghost" onclick="closeModal('mCourseStudents{{ $course->id }}')">Tutup</button>
      </div>
    </div>
  </div>

  <div id="mCourseEdit{{ $course->id }}" class="overlay">
    <div class="modal">
      <div class="modal-hd">
        <h4>Edit Mata Kuliah</h4>
        <div class="modal-x" onclick="closeModal('mCourseEdit{{ $course->id }}')"><i class="fas fa-times"></i></div>
      </div>
      <form method="POST" action="{{ route('matakuliah.update', $course) }}">
        @csrf
        @method('PUT')
        <div class="modal-bd">
          @include('pages.matakuliah._form', ['course' => $course])
        </div>
        <div class="modal-ft">
          <button type="button" class="btn btn-ghost" onclick="closeModal('mCourseEdit{{ $course->id }}')">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endforeach
@endsection

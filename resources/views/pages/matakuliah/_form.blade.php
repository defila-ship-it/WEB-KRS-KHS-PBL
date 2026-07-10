<div class="f-grid f-grid-2">
  <div>
    <label class="f-lbl">Kode MK</label>
    <input class="f-ctrl" name="code" value="{{ old('code', $course->code ?? '') }}" required>
  </div>
  <div>
    <label class="f-lbl">SKS</label>
    <input class="f-ctrl" type="number" min="1" max="6" name="credits" value="{{ old('credits', $course->credits ?? 3) }}" required>
  </div>
  <div style="grid-column:1/-1">
    <label class="f-lbl">Nama Mata Kuliah</label>
    <input class="f-ctrl" name="name" value="{{ old('name', $course->name ?? '') }}" required>
  </div>
  <div>
    <label class="f-lbl">Program Studi</label>
    <select class="f-sel" name="study_program" required>
      @foreach($programs as $program)
        <option value="{{ $program }}" @selected(old('study_program', $course->study_program ?? '') === $program)>{{ $program }}</option>
      @endforeach
    </select>
  </div>
  <div>
    <label class="f-lbl">Semester</label>
    <input class="f-ctrl" type="number" min="1" max="8" name="semester" value="{{ old('semester', $course->semester ?? 1) }}" required>
  </div>
  <div>
    <label class="f-lbl">Jenis Semester</label>
    <select class="f-sel" name="semester_type" required>
      <option value="ganjil" @selected(old('semester_type', $course->semester_type ?? '') === 'ganjil')>Ganjil</option>
      <option value="genap" @selected(old('semester_type', $course->semester_type ?? 'genap') === 'genap')>Genap</option>
    </select>
  </div>
  <div>
    <label class="f-lbl">Dosen Pengampu</label>
    <select class="f-sel" name="lecturer_id">
      <option value="">Belum dipilih</option>
      @foreach($lecturers as $lecturer)
        <option value="{{ $lecturer->id }}" @selected((string) old('lecturer_id', $course->lecturer_id ?? '') === (string) $lecturer->id)>{{ $lecturer->name }}</option>
      @endforeach
    </select>
  </div>
</div>

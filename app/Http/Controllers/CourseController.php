<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Krs;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with(['lecturer', 'krs.student'])
            ->withCount(['krs as krs_count' => fn ($query) => $query->where('status', 'approved')])
            ->when($request->search, fn ($query, $search) => $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            }))
            ->when($request->semester_type, fn ($query, $type) => $query->where('semester_type', $type))
            ->when($request->study_program, fn ($query, $program) => $query->where('study_program', $program))
            ->orderBy('code')
            ->paginate(10)
            ->withQueryString();

        return view('pages.matakuliah.index', [
            'courses' => $courses,
            'lecturers' => Lecturer::orderBy('name')->get(),
            'students' => Student::where('status', 'Aktif')->orderBy('nim')->get(),
            'programs' => $this->programs(),
        ]);
    }

    public function store(Request $request)
    {
        Course::create($this->validated($request));

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function update(Request $request, Course $course)
    {
        $course->update($this->validated($request, $course));

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        if ($course->krs()->exists()) {
            return back()->withErrors(['course' => 'Mata kuliah yang sudah dipilih mahasiswa tidak bisa dihapus.']);
        }

        $course->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }

    public function assignStudent(Request $request, Course $course)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
        ]);

        $student = Student::findOrFail($data['student_id']);

        if ($student->study_program !== $course->study_program) {
            return back()->withErrors(['student_id' => 'Mahasiswa harus berasal dari program studi yang sama dengan mata kuliah.']);
        }

        $existingKrs = Krs::query()
            ->where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->where('academic_year', $student->academic_year)
            ->where('semester_type', $course->semester_type)
            ->first();

        if ($existingKrs?->status === 'approved') {
            return back()->withErrors(['student_id' => 'Mahasiswa sudah masuk di mata kuliah ini.']);
        }

        Krs::updateOrCreate(
            [
                'student_id' => $student->id,
                'course_id' => $course->id,
                'academic_year' => $student->academic_year,
                'semester_type' => $course->semester_type,
            ],
            [
                'status' => 'approved',
                'approved_by' => $request->user()->id,
                'approved_at' => now(),
            ]
        );

        return back()->with('success', $student->name.' berhasil ditambahkan ke '.$course->code.'.');
    }

    public function removeStudent(Course $course, Krs $krs)
    {
        abort_unless($krs->course_id === $course->id, 404);

        if ($krs->grade !== null) {
            return back()->withErrors(['student_id' => 'Mahasiswa yang sudah memiliki nilai tidak bisa dilepas dari mata kuliah.']);
        }

        $studentName = $krs->student->name;
        $krs->delete();

        return back()->with('success', $studentName.' berhasil dilepas dari '.$course->code.'.');
    }

    private function validated(Request $request, ?Course $course = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:20', Rule::unique('courses', 'code')->ignore($course?->id)],
            'name' => ['required', 'string', 'max:255'],
            'credits' => ['required', 'integer', 'min:1', 'max:6'],
            'study_program' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'semester_type' => ['required', Rule::in(['ganjil', 'genap'])],
            'lecturer_id' => ['nullable', 'exists:lecturers,id'],
            'schedule' => ['nullable', 'string', 'max:100'],
            'room' => ['nullable', 'string', 'max:100'],
        ]);
    }

    private function programs(): array
    {
        return ['Sistem Informasi', 'Teknik Informatika', 'Teknik Komputer', 'Manajemen Informatika'];
    }
}

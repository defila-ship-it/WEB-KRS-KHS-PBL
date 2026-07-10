<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::put('/profil', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::get('/matakuliah', [CourseController::class, 'index'])->name('matakuliah.index');
    Route::post('/matakuliah', [CourseController::class, 'store'])->name('matakuliah.store');
    Route::put('/matakuliah/{course}', [CourseController::class, 'update'])->name('matakuliah.update');
    Route::post('/matakuliah/{course}/mahasiswa', [CourseController::class, 'assignStudent'])->name('matakuliah.mahasiswa.store');
    Route::delete('/matakuliah/{course}/mahasiswa/{krs}', [CourseController::class, 'removeStudent'])->name('matakuliah.mahasiswa.destroy');
    Route::delete('/matakuliah/{course}', [CourseController::class, 'destroy'])->name('matakuliah.destroy');

    Route::get('/mahasiswa', [StudentController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [StudentController::class, 'store'])->name('mahasiswa.store');
    Route::put('/mahasiswa/{student}', [StudentController::class, 'update'])->name('mahasiswa.update');

    Route::get('/dosen', [LecturerController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [LecturerController::class, 'store'])->name('dosen.store');
    Route::put('/dosen/{lecturer}', [LecturerController::class, 'update'])->whereNumber('lecturer')->name('dosen.update');

    Route::get('/krs', [KrsController::class, 'adminIndex'])->name('krs.index');
    Route::put('/krs/status/bulk', [KrsController::class, 'bulkUpdateStatus'])->name('krs.status.bulk');
    Route::get('/krs/{student}', [KrsController::class, 'detail'])->name('krs.detail');
    Route::put('/krs/{krs}/status', [KrsController::class, 'updateStatus'])->name('krs.status');

    Route::get('/khs', [GradeController::class, 'adminIndex'])->name('khs.index');

    Route::get('/profil', fn () => view('pages.profil.index'))->name('profil');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/krs', [KrsController::class, 'mahasiswaIndex'])->name('mahasiswa.krs');
    Route::post('/mahasiswa/krs', [KrsController::class, 'storeMahasiswa'])->name('mahasiswa.krs.store');
    Route::delete('/mahasiswa/krs/{krs}', [KrsController::class, 'destroyMahasiswa'])->name('mahasiswa.krs.destroy');
    Route::get('/mahasiswa/khs', [GradeController::class, 'mahasiswaIndex'])->name('mahasiswa.khs');
    Route::get('/mahasiswa/khs/pdf', [GradeController::class, 'exportMahasiswaPdf'])->name('mahasiswa.khs.pdf');
    Route::get('/mahasiswa/profil', fn () => view('pages.mahasiswa.profil.index'))->name('mahasiswa.profil');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'dosen'])->name('dosen.dashboard');
    Route::get('/dosen/krs', [GradeController::class, 'dosenKrs'])->name('dosen.krs');
    Route::get('/dosen/khs', [GradeController::class, 'dosenKhs'])->name('dosen.khs');
    Route::get('/dosen/input-nilai', [GradeController::class, 'inputNilai'])->name('dosen.input-nilai');
    Route::put('/dosen/input-nilai', [GradeController::class, 'bulkUpdate'])->name('dosen.nilai.bulk-update');
    Route::put('/dosen/input-nilai/{krs}', [GradeController::class, 'update'])->name('dosen.nilai.update');
    Route::get('/dosen/profil', fn () => view('pages.dosen.profil.index'))->name('dosen.profil');
});

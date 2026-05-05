<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| DEMO MODE — TANPA CONTROLLER & AUTH
|--------------------------------------------------------------------------
| Semua hanya tampilan (view saja)
| Login hanya redirect ke dashboard
|
*/

/*
|--------------------------------------------------------------------------
| Login Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login'); // resources/views/login.blade.php
});

Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('pages.dashboard'); // resources/views/dashboard.blade.php
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Mata Kuliah (Tampilan)
|--------------------------------------------------------------------------
*/
Route::get('/matakuliah', function () {
    return view('pages.matakuliah.index');
});


/*
|--------------------------------------------------------------------------
| Mahasiswa (Tampilan)
|--------------------------------------------------------------------------
*/
Route::get('/mahasiswa', function () {
    return view('pages.mahasiswa.index');
});
Route::get('/mahasiswa/create', function () {
    return view('pages.mahasiswa.create');
});


/*
|--------------------------------------------------------------------------
| Dosen (Tampilan)
|--------------------------------------------------------------------------
*/
Route::get('/dosen', function () {
    return view('pages.dosen.index');
});
Route::get('/dosen/create', function () {
    return view('pages.dosen.create');
});


/*
|--------------------------------------------------------------------------
| KRS (Tampilan)
|--------------------------------------------------------------------------
*/
Route::get('/krs', function () {
    return view('pages.krs.index');
});

Route::get('/krs/{nim}', function ($nim) {
    return view('pages.krs.detail', compact('nim'));
});


/*
|--------------------------------------------------------------------------
| KHS (Tampilan)
|--------------------------------------------------------------------------
*/
Route::get('/khs', function () {
    return view('pages.khs.index');
});

Route::get('/khs/{nim}', function ($nim) {
    return view('pages.khs.detail', compact('nim'));
});

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

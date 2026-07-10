@extends('layouts.app-mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<div class="page">

    <div class="ph">
        <div class="ph-text">
            <h2>Dashboard Mahasiswa</h2>
            <p>Selamat datang, Ema Merlisa</p>
        </div>
    </div>

    <div class="stat-grid">

        <div class="stat">
            <div class="stat-ic ic-blue">
                <i class="fas fa-book"></i>
            </div>

            <div>
                <div class="stat-n">20</div>
                <div class="stat-l">SKS Diambil</div>
            </div>
        </div>

        <div class="stat">
            <div class="stat-ic ic-green">
                <i class="fas fa-chart-line"></i>
            </div>

            <div>
                <div class="stat-n">3.85</div>
                <div class="stat-l">IPK</div>
            </div>
        </div>

        <div class="stat">
            <div class="stat-ic ic-amber">
                <i class="fas fa-file-alt"></i>
            </div>

            <div>
                <div class="stat-n">6</div>
                <div class="stat-l">Mata Kuliah</div>
            </div>
        </div>

        <div class="stat">
            <div class="stat-ic ic-purple">
                <i class="fas fa-star"></i>
            </div>

            <div>
                <div class="stat-n">A</div>
                <div class="stat-l">Prestasi Akademik</div>
            </div>
        </div>

    </div>

    <div class="card">
    <div class="card-hd">
        <h3>Informasi Akademik</h3>
    </div>

    <div class="card-bd">
        <div class="tbl-wrap">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>IPK</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>231510001</td>
                        <td>Ema Merlisa</td>
                        <td>6</td>
                        <td>3.85</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
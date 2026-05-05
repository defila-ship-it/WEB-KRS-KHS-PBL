@extends('layouts.app')

@section('title', 'Profile')
@section('page_title', 'Profile')
<?php

$nama = "Defila Anggraini";
$kelas = "TI-3A";
$nim = "123456789";
$prodi = "Teknik Informatika";
$jurusan = "Teknologi Informasi";
$foto = "Defila18.jpg"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2d2f7f;
            color: white;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .menu {
            margin-top: 30px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .menu a:hover {
            background: #4446a1;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            width: 80%;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 500px;
            display: flex;
            gap: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .profile-img img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .profile-info input {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
        }

        .btn {
            margin-top: 10px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>POLIBATAM</h2>

    <div class="menu">
        <a href="#">Dashboard</a>
        <a href="#">KRS</a>
        <a href="#">KHS</a>
        <a href="#">Profil</a>
    </div>

    <div class="logout">
        <a href="#" style="color:red;">Logout</a>
    </div>
</div>

<div class="main">
    <h3>Profil</h3>
    <h2>Profil Mahasiswa</h2>

    <div class="profile-container">
        <div class="profile-img">
            <img src="<?php echo $foto; ?>" alt="Foto">
            <br>
            <button class="btn">Ubah Foto</button>
        </div>

        <div class="profile-info">
            Nama:
            <input type="text" value="<?php echo $nama; ?>" readonly>

            Kelas:
            <input type="text" value="<?php echo $kelas; ?>" readonly>

            NIM:
            <input type="text" value="<?php echo $nim; ?>" readonly>

            Prodi:
            <input type="text" value="<?php echo $prodi; ?>" readonly>

            Jurusan:
            <input type="text" value="<?php echo $jurusan; ?>" readonly>
        </div>
    </div>
</div>

</body>
</html>
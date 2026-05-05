@extends('layouts.app')

@section('content')

<style>
    .page {
    display: flex;
    min-height: 100vh;
    font-family: Arial, sans-serif;
}

.logo {
    font-weight: bold;
    margin-bottom: 20px;
}

.logout {
    margin-top: auto;
    color: #ff6b6b;
}

/* CONTENT */
.content {
    flex: 1;
    padding: 30px;
    background: #f5f5f5;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 6px;
    width: 500px;
}

/* FORM */
.form-group {
    margin-bottom: 15px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.row {
    display: flex;
    gap: 10px;
}

.row .form-group {
    flex: 1;
}

/* BUTTON */
.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-cancel {
    background: #ddd;
    border: none;
    padding: 8px 15px;
}

.btn-save {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 8px 15px;
}
</style>

<div class="page">

    <!-- CONTENT -->
    <div class="content">
        <h2>Tambah Mahasiswa</h2>

        <div class="card">
            <form>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text">
                </div>

                <div class="row">
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select>
                            <option>Pilih Prodi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Angkatan</label>
                        <select>
                            <option>2024</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Semester</label>
                    <select>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email">
                </div>

                <div class="actions">
                    <button type="button" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
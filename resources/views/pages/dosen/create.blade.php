@extends('layouts.app')

@section('content')

<style>
    .content {
    padding: 30px;
    background: #f5f5f5;
    min-height: 100vh;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 6px;
    width: 450px;
}

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

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
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

<div class="content">
    <h2>Tambah Dosen</h2>

    <div class="card">
        <form>
            <div class="form-group">
                <label>NIDN</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>Program Studi</label>
                <select>
                    <option>Pilih Prodi</option>
                    <option>Teknik Informatika</option>
                    <option>Sistem Informasi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email">
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <input type="text">
            </div>

            <div class="actions">
                <button type="button" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
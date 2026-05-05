@extends('layouts.app')

@section('content')

<style>
/* ===== LAYOUT ===== */
.dashboard-wrap {
  padding: 20px;
  background: #f4f4f4;
  min-height: 100vh;
}

/* HEADER */
.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.topbar h2 {
  margin: 0;
}

.user-box {
  display: flex;
  align-items: center;
  gap: 10px;
}

.avatar {
  width: 35px;
  height: 35px;
  background: #3b82f6;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

/* CARDS */
.cards {
  display: flex;
  gap: 15px;
}

.card {
  background: #e5e5e5;
  padding: 15px;
  width: 180px;
  border-radius: 6px;
}

.card h4 {
  margin: 0 0 5px;
  font-size: 14px;
}

.card .num {
  font-size: 20px;
  font-weight: bold;
}

.card small {
  color: #555;
}
</style>

<div class="dashboard-wrap">

  <div class="cards">

    <div class="card">
      <h4>Mahasiswa Aktif</h4>
      <div class="num">1.250</div>
      <small>Lihat detail</small>
    </div>

    <div class="card">
      <h4>KRS Disetujui</h4>
      <div class="num">980</div>
      <small>Lihat detail</small>
    </div>

    <div class="card">
      <h4>KHS Terbit</h4>
      <div class="num">870</div>
      <small>Lihat detail</small>
    </div>

  </div>

</div>

@endsection
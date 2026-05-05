@extends('layouts.app')

@section('content')

<style>
/* ===== VARIABLES & RESET ===== */
:root {
  --primary: #4361ee;
  --primary-dark: #3a0ca3;
  --secondary: #7209b7;
  --success: #4cc9f0;
  --danger: #f72585;
  --warning: #f8961e;
  --dark: #1a1a2e;
  --gray: #6c757d;
  --light-gray: #f8f9fa;
  --border-radius: 16px;
  --box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  --transition: all 0.3s ease;
}

/* ===== LAYOUT ===== */
.dashboard-wrap {
  padding: 25px 30px;
  background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
  min-height: 100vh;
}

/* ===== HEADER / TOPBAR ===== */
.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 35px;
  background: white;
  padding: 15px 25px;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
}

.topbar h2 {
  margin: 0;
  font-size: 24px;
  font-weight: 700;
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.user-box {
  display: flex;
  align-items: center;
  gap: 15px;
  cursor: pointer;
  padding: 5px 15px 5px 10px;
  border-radius: 50px;
  transition: var(--transition);
  background: var(--light-gray);
}

.user-box:hover {
  background: #e9ecef;
  transform: translateY(-2px);
}

.avatar {
  width: 42px;
  height: 42px;
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 16px;
  box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
}

.user-info {
  text-align: right;
}

.user-name {
  font-weight: 600;
  font-size: 14px;
  color: var(--dark);
}

.user-role {
  font-size: 11px;
  color: var(--gray);
}

/* ===== STATS CARDS ===== */
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
  margin-bottom: 35px;
}

.card {
  background: white;
  padding: 0;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
  cursor: pointer;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
}

.card.blue::before {
  background: linear-gradient(90deg, var(--primary), var(--success));
}

.card.green::before {
  background: linear-gradient(90deg, #06d6a0, #118ab2);
}

.card.orange::before {
  background: linear-gradient(90deg, var(--warning), #ffb347);
}

.card-content {
  padding: 25px;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.card-icon {
  width: 55px;
  height: 55px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}

.card-icon.blue-bg {
  background: rgba(67, 97, 238, 0.1);
  color: var(--primary);
}

.card-icon.green-bg {
  background: rgba(6, 214, 160, 0.1);
  color: #06d6a0;
}

.card-icon.orange-bg {
  background: rgba(248, 150, 30, 0.1);
  color: var(--warning);
}

.trend {
  font-size: 12px;
  padding: 5px 10px;
  border-radius: 20px;
  font-weight: 600;
}

.trend.up {
  background: rgba(6, 214, 160, 0.15);
  color: #06d6a0;
}

.trend.down {
  background: rgba(247, 37, 133, 0.1);
  color: var(--danger);
}

.card h4 {
  margin: 0 0 8px;
  font-size: 14px;
  font-weight: 500;
  color: var(--gray);
  letter-spacing: 0.5px;
}

.num {
  font-size: 36px;
  font-weight: 800;
  color: var(--dark);
  margin-bottom: 15px;
  line-height: 1;
}

.card-link {
  color: var(--primary);
  text-decoration: none;
  font-size: 13px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: var(--transition);
}

.card-link:hover {
  gap: 8px;
  color: var(--primary-dark);
}

/* ===== CHART SECTION ===== */
.chart-section {
  background: white;
  border-radius: var(--border-radius);
  padding: 20px;
  margin-bottom: 35px;
  box-shadow: var(--box-shadow);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 15px;
}

.chart-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: var(--dark);
  display: flex;
  align-items: center;
  gap: 10px;
}

.chart-header h3 i {
  color: var(--primary);
}

.chart-tabs {
  display: flex;
  gap: 10px;
}

.chart-tab {
  padding: 5px 15px;
  border: none;
  background: var(--light-gray);
  border-radius: 20px;
  cursor: pointer;
  font-size: 12px;
  font-weight: 500;
  transition: var(--transition);
}

.chart-tab.active {
  background: var(--primary);
  color: white;
}

canvas {
  max-height: 280px;
  width: 100% !important;
}

/* ===== RECENT ACTIVITIES ===== */
.activities-section {
  background: white;
  border-radius: var(--border-radius);
  padding: 20px;
  box-shadow: var(--box-shadow);
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.section-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: var(--dark);
  display: flex;
  align-items: center;
  gap: 10px;
}

.section-header a {
  color: var(--primary);
  text-decoration: none;
  font-size: 13px;
  font-weight: 500;
}

.activity-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.activity-item {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 12px;
  border-radius: 12px;
  transition: var(--transition);
  background: var(--light-gray);
}

.activity-item:hover {
  background: #e9ecef;
  transform: translateX(5px);
}

.activity-icon {
  width: 45px;
  height: 45px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.activity-details {
  flex: 1;
}

.activity-title {
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 4px;
  font-size: 14px;
}

.activity-time {
  font-size: 11px;
  color: var(--gray);
}

.status-badge {
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
}

.status-success {
  background: rgba(6, 214, 160, 0.15);
  color: #06d6a0;
}

.status-warning {
  background: rgba(248, 150, 30, 0.15);
  color: var(--warning);
}

.status-info {
  background: rgba(67, 97, 238, 0.1);
  color: var(--primary);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .dashboard-wrap {
    padding: 15px;
  }
  
  .cards {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .topbar {
    flex-direction: column;
    gap: 15px;
    text-align: center;
  }
  
  .user-box {
    padding: 8px 20px;
  }
  
  .chart-header {
    flex-direction: column;
  }
}
</style>

<div class="dashboard-wrap">

  <!-- TOPBAR -->
  <div class="topbar">
    <h2>
      <i class="fas fa-chart-line" style="margin-right: 8px;"></i>
      Dashboard
    </h2>
    <div class="user-box">
      <div class="user-info">
        <div class="user-name">Eka Maulana</div>
        <div class="user-role">Administrator</div>
      </div>
      <div class="avatar">EM</div>
    </div>
  </div>

  <!-- STATISTICS CARDS -->
  <div class="cards">
    <div class="card blue">
      <div class="card-content">
        <div class="card-header">
          <div class="card-icon blue-bg">
            <i class="fas fa-users"></i>
          </div>
          <div class="trend up">
            <i class="fas fa-arrow-up"></i> +12%
          </div>
        </div>
        <h4>MAHASISWA AKTIF</h4>
        <div class="num">1.250</div>
        <a href="#" class="card-link">
          Lihat detail <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <div class="card green">
      <div class="card-content">
        <div class="card-header">
          <div class="card-icon green-bg">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="trend up">
            <i class="fas fa-arrow-up"></i> +8%
          </div>
        </div>
        <h4>KRS DISETUJUI</h4>
        <div class="num">980</div>
        <a href="#" class="card-link">
          Lihat detail <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <div class="card orange">
      <div class="card-content">
        <div class="card-header">
          <div class="card-icon orange-bg">
            <i class="fas fa-file-alt"></i>
          </div>
          <div class="trend up">
            <i class="fas fa-arrow-up"></i> +5%
          </div>
        </div>
        <h4>KHS TERBIT</h4>
        <div class="num">870</div>
        <a href="#" class="card-link">
          Lihat detail <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  
  <!-- RECENT ACTIVITIES -->
  <div class="activities-section">
    <div class="section-header">
      <h3>
        <i class="fas fa-history"></i>
        Aktivitas Terbaru
      </h3>
      <a href="#">Lihat semua <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="activity-list">
      <div class="activity-item">
        <div class="activity-icon" style="background: rgba(67, 97, 238, 0.1); color: var(--primary);">
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="activity-details">
          <div class="activity-title">Mahasiswa baru mendaftar</div>
          <div class="activity-time"><i class="far fa-clock"></i> 10 menit yang lalu</div>
        </div>
        <span class="status-badge status-info">Pending</span>
      </div>
      
      <div class="activity-item">
        <div class="activity-icon" style="background: rgba(6, 214, 160, 0.1); color: #06d6a0;">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="activity-details">
          <div class="activity-title">KRS mahasiswa disetujui</div>
          <div class="activity-time"><i class="far fa-clock"></i> 1 jam yang lalu</div>
        </div>
        <span class="status-badge status-success">Disetujui</span>
      </div>
      
      <div class="activity-item">
        <div class="activity-icon" style="background: rgba(248, 150, 30, 0.1); color: var(--warning);">
          <i class="fas fa-file-pdf"></i>
        </div>
        <div class="activity-details">
          <div class="activity-title">KHS semester ganjil 2025 diterbitkan</div>
          <div class="activity-time"><i class="far fa-clock"></i> 3 jam yang lalu</div>
        </div>
        <span class="status-badge status-success">Terbit</span>
      </div>
      
      <div class="activity-item">
        <div class="activity-icon" style="background: rgba(67, 97, 238, 0.1); color: var(--primary);">
          <i class="fas fa-edit"></i>
        </div>
        <div class="activity-details">
          <div class="activity-title">Pengajuan perubahan jadwal kuliah</div>
          <div class="activity-time"><i class="far fa-clock"></i> 5 jam yang lalu</div>
        </div>
        <span class="status-badge status-warning">Review</span>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let currentChart = null;

function changeChart(type) {
  const data = {
    student: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: 'Mahasiswa Baru',
        data: [45, 52, 48, 60, 75, 82, 95, 110, 125, 140, 155, 168],
        borderColor: '#4361ee',
        backgroundColor: 'rgba(67, 97, 238, 0.1)',
        borderWidth: 3,
        tension: 0.4,
        fill: true,
      }]
    },
    krs: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
      datasets: [{
        label: 'KRS Disetujui',
        data: [120, 145, 168, 190, 210, 245],
        borderColor: '#06d6a0',
        backgroundColor: 'rgba(6, 214, 160, 0.1)',
        borderWidth: 3,
        tension: 0.4,
        fill: true,
      }]
    },
    khs: {
      labels: ['Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
      datasets: [{
        label: 'KHS Terbit',
        data: [80, 95, 110, 145, 180, 210],
        borderColor: '#f8961e',
        backgroundColor: 'rgba(248, 150, 30, 0.1)',
        borderWidth: 3,
        tension: 0.4,
        fill: true,
      }]
    }
  };
  
  if (currentChart) {
    currentChart.destroy();
  }
  
  const ctx = document.getElementById('academicChart').getContext('2d');
  currentChart = new Chart(ctx, {
    type: 'line',
    data: data[type],
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          mode: 'index',
          intersect: false,
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            color: '#e9ecef',
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });
  
  // Update active tab style
  document.querySelectorAll('.chart-tab').forEach(tab => {
    tab.classList.remove('active');
  });
  event.target.classList.add('active');
}

// Initialize chart
document.addEventListener('DOMContentLoaded', function() {
  changeChart('student');
});
</script>

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection
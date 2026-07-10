@php
  $user = auth()->user();
  $profile = $user->student ?? $user->lecturer;
  $roleLabel = ucfirst($user->role);
@endphp

<div class="ph">
  <div class="ph-text">
    <h2>Profil Akun</h2>
    <p>Kelola informasi dan keamanan akun {{ strtolower($roleLabel) }}</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert alert-warn"><i class="fas fa-exclamation-circle"></i>{{ $errors->first() }}</div>
@endif

<div class="profile-grid">
  <div class="profile-card">
    <div class="profile-av">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
    <div class="profile-name">{{ $user->name }}</div>
    <div class="profile-role">{{ $roleLabel }}</div>
    <span class="badge b-success">Akun Aktif</span>

    <div class="profile-info">
      <div class="pi-label">Kontak</div>
      <div class="pi-row"><i class="fas fa-envelope"></i> {{ $user->email }}</div>
      <div class="pi-row"><i class="fas fa-phone"></i> {{ $profile->phone ?? '-' }}</div>
      <div class="pi-row"><i class="fas fa-building"></i> Politeknik Negeri Batam</div>
    </div>
  </div>

  <div class="card">
    <div class="card-hd"><h3>Edit Profil</h3></div>
    <div class="card-bd">
      <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="f-grid f-grid-2">
          <div>
            <label class="f-lbl">Nama Lengkap</label>
            <input class="f-ctrl" name="name" value="{{ old('name', $user->name) }}" required>
          </div>
          <div>
            <label class="f-lbl">Email</label>
            <input class="f-ctrl" type="email" name="email" value="{{ old('email', $user->email) }}" required>
          </div>
          <div>
            <label class="f-lbl">No. Telepon</label>
            <input class="f-ctrl" name="phone" value="{{ old('phone', $profile->phone ?? '') }}">
          </div>
          <div>
            <label class="f-lbl">Alamat</label>
            <input class="f-ctrl" name="address" value="{{ old('address', $profile->address ?? '') }}">
          </div>
        </div>
        <div class="f-actions">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </div>
      </form>

      <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
        <div style="font-size:14px;font-weight:700;color:var(--text);margin-bottom:16px;font-family:var(--font-head)">
          <i class="fas fa-lock" style="color:var(--text-3);margin-right:8px;font-size:13px"></i>Ubah Password
        </div>
        <form method="POST" action="{{ route('profile.password') }}">
          @csrf
          @method('PUT')
          <div class="f-grid f-grid-2">
            <div>
              <label class="f-lbl">Password Saat Ini</label>
              <input class="f-ctrl" type="password" name="current_password" placeholder="Masukkan password lama" required>
            </div>
            <div></div>
            <div>
              <label class="f-lbl">Password Baru</label>
              <input class="f-ctrl" type="password" name="password" placeholder="Min. 8 karakter" required>
            </div>
            <div>
              <label class="f-lbl">Konfirmasi Password</label>
              <input class="f-ctrl" type="password" name="password_confirmation" placeholder="Ulangi password baru" required>
            </div>
          </div>
          <div class="f-actions">
            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Ubah Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

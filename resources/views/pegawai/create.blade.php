@extends('layoutbootstrap')

@section('konten')
 <!--  Main wrapper -->
 <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)" style="color: #bddcff;">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)" style="color: #052bab;">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
              <ul class="navbar-nav flex-row align-items-center justify-content-end">
                  <!-- Profile Info with Dropdown -->
                  <li class="nav-item dropdown" style="position: relative;">
                      <a href="javascript:void(0)" id="profileDropdown" class="nav-link d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                          <div class="d-flex align-items-center gap-2 profile-container">
                              <img src="{{ asset('images/profile/user-1.jpg') }}" alt="User Avatar" width="30" height="30" class="rounded-circle">
                              <span class="profile-name">{{ Auth::user()->name }}</span>
                          </div>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#"><i class="ti ti-user"></i> Profil Saya</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-settings"></i> Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-lock"></i> Pengaturan Keamanan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-help"></i> Bantuan & Dukungan</a></li>
                          <li>
                              <a class="dropdown-item logout-btn" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="ti ti-logout"></i> Logout
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </li>
                      </ul>
                  </li>
              </ul>
          </div>
          
          <style>
              /* Navbar Positioning */
              .navbar-collapse {
                  display: flex;
                  justify-content: flex-end;
                  position: absolute;
                  top: 10px; /* Adjust as needed */
                  right: 10px; /* Pojok kanan */
                  z-index: 1000; /* Make sure it stays above other elements */
              }
          
              /* Profile Container */
              .profile-container {
                  background-color: #bddcff;
                  border-radius: 8px;
                  padding: 0 15px; /* Padding horizontal saja */
                  height: 50px;
                  display: flex;
                  align-items: center;
                  gap: 6px;
                  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                  transition: background-color 0.3s ease, transform 0.2s ease-in-out;
              }
          
              .profile-container:hover {
                  background-color: #d9e7ff; /* Hover effect */
                  transform: scale(1.05); /* Sedikit efek zoom */
              }
          
              .profile-container img {
                  border-radius: 50%;
                  width: 30px; /* Ukuran gambar */
                  height: 30px;
              }
          
              .profile-name {
                  font-size: 15px; /* Ukuran font untuk nama */
                  font-weight: 600;
                  color: #052bab;
                  line-height: 50px; /* Sesuaikan tinggi dengan foto */
              }
          
              /* Dropdown Menu */
              .dropdown-menu {
                  background-color: #bddcff;
                  border-radius: 8px;
                  margin-top: 10px;
                  width: 200px;
                  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                  padding: 10px 0;
                  opacity: 0;
                  visibility: hidden;
                  transform: translateY(10px);
                  transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
              }
          
              .nav-item:hover .dropdown-menu {
                  opacity: 1;
                  visibility: visible;
                  transform: translateY(0);
              }
          
              .dropdown-item {
                  font-size: 14px;
                  color: #052bab;
                  padding: 8px 15px;
                  transition: background-color 0.3s ease, transform 0.2s ease;
              }
          
              .dropdown-item i {
                  margin-right: 8px;
                  color: #052bab;
              }
          
              .dropdown-item:hover {
                  background-color: #e3f2fd;
                  transform: translateX(5px);
              }
          
              /* Logout Button Styling */
              .logout-btn {
                  font-weight: bold;
                  color: #052bab;
              }
          
              .logout-btn:hover {
                  background-color: #ffe5e5;
              }
          </style>           
        </nav>
      </header>
<!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data pegawai</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->                
                <form action="{{ route('pegawai.store') }}" method="post">
                @csrf
                <div class="form-container mt-5 p-4 border rounded shadow-sm bg-light">
                    <h3 class="text-center mb-4">Form Pegawai</h3>

                    <!-- Nama Pegawai -->
                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                        <input class="form-control" id="nama_pegawai" name="nama_pegawai" type="text" placeholder="Masukkan nama pegawai" value="{{ old('nama_pegawai') }}" required oninput="generateEmail()">
                    </div>

                    <!-- Nomor Pegawai -->
                    <div class="mb-3">
                        <label for="nomor_pegawai" class="form-label">Nomor Pegawai</label>
                        <input class="form-control" id="nomor_pegawai" name="nomor_pegawai" type="number" placeholder="Masukkan nomor pegawai" value="{{ old('nomor_pegawai') }}" required>
                    </div>

                    <!-- Email Pegawai -->
                    <div class="mb-3">
                        <label for="email_pegawai" class="form-label">Email Pegawai</label>
                        <input class="form-control" id="email_pegawai" name="email_pegawai" type="email" placeholder="Masukkan email pegawai" value="{{ old('email_pegawai') }}" required>
                    </div>

                    <!-- Tombol Simpan dan Batal -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success w-48">Simpan</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-dark w-48">Batal</a>
                    </div>
                </div>
            </form>

            <script>
                function generateEmail() {
                    let namaPegawai = document.getElementById('nama_pegawai').value;
                    let emailField = document.getElementById('email_pegawai');
                
                    let email = namaPegawai.replace(/\s+/g, '').toLowerCase() + '@gmail.com';

                    emailField.value = email;
                }
            </script>
@endsection
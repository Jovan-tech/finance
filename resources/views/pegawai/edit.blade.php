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
        </nav>
      </header>
<!--  Header End --> 
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Edit Data Pegawai</h5>

                  <!-- Display Error if there are any errors -->
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <!-- Begin Form Input -->
                  <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
                      @csrf
                      @method('PUT')

                      <style>
                         /* Global Form Styles */
                      .form-container {
                          font-family: Arial, sans-serif;
                          margin: 20px;
                      }
                      
                      .form-container label {
                          font-size: 16px;
                          font-weight: bold;
                          color: #333;
                          margin-bottom: 5px;
                          display: block;
                      }

                      .form-container input:focus, 
                      .form-container select:focus, 
                      .form-container textarea:focus {
                          border-color: #007bff;
                          background-color: #fff;
                          outline: none;
                      }
                  

                      .form-container .btn {
                          padding: 8px 20px;
                          font-size: 14px;
                          font-weight: bold;
                          text-transform: uppercase;
                          border-radius: 5px;
                          text-decoration: none;
                          transition: background-color 0.3s ease;
                      }
                  

                      .form-container .btn-success {
                          background-color: #28a745;
                          color: #fff;
                          border: none;
                      }

                      .form-container .btn-success:hover {
                          background-color: #218838;
                      }
                      
                      .form-container .row {
                          display: flex;
                          gap: 10px;
                      }
                      

                      </style>

                      <!-- Pegawai ID (Read-Only) -->
                      <fieldset disabled>
                          <div class="mb-3">
                              <label for="pegawai_id" class="form-label">ID Pegawai</label>
                              <input class="form-control" id="pegawai_id" name="pegawai_id" type="text" value="{{ $pegawai->id }}" readonly>
                          </div>
                      </fieldset>

                      <!-- Nama Pegawai -->
                      <div class="mb-3">
                          <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                          <input class="form-control" id="nama_pegawai" name="nama_pegawai" type="text" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                      </div>

                      <!-- No. Telepon -->
                      <div class="mb-3">
                          <label for="telepon" class="form-label">No. Telepon</label>
                          <input class="form-control" id="nomor_pegawai" name="nomor_pegawai" type="number" value="{{ old('nomor_pegawai', $pegawai->nomor_pegawai) }}" required>
                      </div>

                        <!-- No. Telepon -->
                        <div class="mb-3">
                          <label for="telepon" class="form-label">Email</label>
                          <input class="form-control" id="email_pegawai" name="email_pegawai" type="email" value="{{ old('email_pegawai', $pegawai->email_pegawai) }}" required>
                      </div>

                      <!-- Submit Button -->
                      <div class="mb-3">
                          <button type="submit" class="btn btn-success">Simpan</button>
                          <a href="{{ route('pegawai.index') }}" class="btn btn-dark">Kembali</a>
                      </div>
                  </form>
                  <!-- End Form Input -->

              </div>
          </div>
      </div>
</div>
@endsection

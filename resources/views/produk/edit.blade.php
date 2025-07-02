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
                  <h5 class="card-title fw-semibold mb-4">Data Produk</h5>
      
                  <!-- Display Error jika ada error -->
                  @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

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

                      @csrf
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
                  
                      .form-container fieldset {
                          border: none;
                          padding: 0;
                          margin: 0 0 15px 0;
                      }
                  
                      .form-container textarea {
                          resize: vertical;
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
                  
                      .form-container .btn-dark {
                          background-color: #343a40;
                          color: #fff;
                          border: none;
                      }

                      .form-container .btn-dark:hover {
                          background-color: #23272b;
                      }
                  
                      .form-container .row {
                          display: flex;
                          gap: 10px;
                      }
                      
                        .btn {
                        border-radius: 5px;
                        padding: 5px 10px;
                        font-size: 14px;
                        font-weight: bold;
                        text-transform: uppercase;
                        transition: background-color 0.3s ease, transform 0.2s;
                        }
                        
                      .btn:hover {
                      transform: translateY(-2px);
                      }
                    </style>
                      <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-container">
                                  <!-- Kode Produk (Read-Only) -->
                                  <fieldset disabled>
                                      <div class="mb-3">
                                          <label for="kode_produk_tampil" class="form-label">Kode Produk</label>
                                          <input class="form-control" id="kode_produk_tampil" name="kode_produk_tampil" type="text" placeholder="Contoh: PK-001" value="{{ $produk->kode_produk }}" readonly>
                                      </div>
                                  </fieldset>
                                  <input type="hidden" id="kode_produk" name="kode_produk" value="{{ $produk->kode_produk }}">
                      
                                  <!-- Nama Produk -->
                                  <div class="mb-3">
                                      <label for="nama_produk" class="form-label">Nama Produk</label>
                                      <input class="form-control" id="nama_produk" name="nama_produk" type="text" placeholder="Masukkan nama produk, contoh: Hoodie Oversize" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                  </div>
                      
                                  <!-- Kategori Produk -->
                                  <div class="mb-3">
                                      <label for="kategori" class="form-label">Kategori</label>
                                      <select class="form-select" id="kategori" name="kategori" required>
                                          <option value="" disabled>Pilih Kategori</option>
                                          <option value="Menu Tambahan" {{ $produk->kategori == 'Menu Tambahan' ? 'selected' : '' }}>Menu Tambahan</option>
                                          <option value="Topping" {{ $produk->kategori == 'Topping' ? 'selected' : '' }}>Topping</option>
                                          <option value="Menu Utama" {{ $produk->kategori == 'Menu Utama' ? 'selected' : '' }}>Menu Utama</option>
                                          <option value="Minuman" {{ $produk->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                      </select>
                                  </div>

                                  <!-- Harga Produk -->
                                  <div class="mb-3">
                                      <label for="harga" class="form-label">Harga</label>
                                      <input class="form-control" id="harga" name="harga" type="text" placeholder="Contoh: Rp. 150.000"
                                        value="{{ old('harga', 'Rp. ' . number_format($produk->harga, 0, ',', '.')) }}" required>
                                  </div>

                                  <!-- Gambar Produk -->
                                  <div class="mb-3">
                                      <label for="gambar" class="form-label">Gambar</label>
                                      <input class="form-control" id="gambar" name="gambar" type="file">
                                      <div class="form-text">Unggah gambar produk dalam format JPG, PNG, atau JPEG. (Opsional)</div>
                                      <div id="gambarWarning" class="alert alert-warning mt-2" style="display: none;">
                                        File terlalu besar (>200KB), mungkin tidak akan berhasil diupload.
                                      </div>
                                      @if($produk->gambar)
                                        <img src="{{ route('produk.image', $produk->id) }}" alt="Gambar Produk" width="100">
                                      @endif
                                  </div>
                      
                                  <!-- Tombol Simpan dan Batal -->
                                  <div class="d-flex justify-content-between">
                                      <button type="submit" class="btn btn-success w-48">Simpan</button>
                                      <a href="{{ url('/produk') }}" class="btn btn-dark w-48">Batal</a>
                                  </div>
                              </form>
                          </div>
                      
                          <!-- Script untuk Format Harga -->
                <script>
                    const hargaInput = document.getElementById('harga');

                    function formatRupiahInput(element) {
                        let value = element.value.replace(/[^\d]/g, '');
                        if (value) {
                            element.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
                        } else {
                            element.value = '';
                        }
                    }

                    hargaInput.addEventListener('input', function (e) {
                        formatRupiahInput(e.target);
                    });

                    // Panggil sekali saat halaman selesai load
                    document.addEventListener('DOMContentLoaded', function () {
                        formatRupiahInput(hargaInput);
                    });
                </script>

                <script>
                    document.getElementById('gambar').addEventListener('change', function (e) {
                        const file = e.target.files[0];
                        const warning = document.getElementById('gambarWarning');

                        if (file && file.size > 200 * 1024) { // 200KB = 200 * 1024 bytes
                            warning.style.display = 'block';
                        } else {
                            warning.style.display = 'none';
                        }
                    });
                </script>
            @endsection
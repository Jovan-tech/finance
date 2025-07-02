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
    </header>
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

        .custom-card-title {
            color: #052bab;
            font-size: 30px; /* Adjust this size to your preference */
            font-weight: 600; /* You can use fw-semibold or adjust the font weight */
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

        /* General Styling */
        .custom-card-title {
            color: #052bab;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    
        /* Header Styling */
        .custom-header {
            background-color: #bddcff;
            color: #052bab;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        /* Table Styling */
        .table-container {
            margin-top: 20px;
        }
    
        table {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 100%;
            text-align: center;
        }
    
        thead, tfoot {
            background-color: #bddcff;
            color: #052bab;
        }
    
        tbody tr {
            background-color: #f8fbff;
            transition: background-color 0.3s ease;
        }
    
        tbody tr:hover {
            background-color: #e3efff; /* Highlight on hover */
        }
    
        tbody td {
            color: #052bab;
            vertical-align: middle;
            font-size: 16px;
        }
    
        /* Button Styling */
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
    
        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }
    
        .btn-success:hover {
            background-color: #218838;
        }
    
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
    
        .btn-danger:hover {
            background-color: #c82333;
        }
    
        .btn-add {
            background-color: #f3f8ff;
            color: #052bab;
            font-weight: bold;
            font-size: 14px;
        }
    
        .btn-add:hover {
            background-color: #a6d3ff;
            color: #000;
        }
    </style>
    
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="custom-card-title">Master Data Pegawai</h5>
                            <div class="card">
                                <!-- Header Section -->
                                <div class="card-header custom-header d-flex justify-content-between align-items-center">
                                    <span>Daftar Pegawai</span>
                                    <a href="{{ url('/pegawai/create') }}" class="btn btn-add">
                                        <i class="ti ti-plus"></i> Tambah Data
                                    </a>
                                </div>
                                <!-- Table Section -->
                                <div class="card-body table-container">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Nama Pegawai</th>
                                                <th>Nomor Pegawai</th>
                                                <th>Email Pegawai</th>                                                
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>                                            
                                            <tbody>
                                            @forelse ($pegawai as $P)
                                                  <tr>
                                                      <td>{{ $P->nama_pegawai }}</td>
                                                      <td>{{ $P->nomor_pegawai }}</td>
                                                      <td>{{ $P->email_pegawai }}</td>                                                      
                                                        <td>   
                                                        <a href="{{ route('pegawai.edit', $P->id) }}" class="btn btn-sm btn-warning">Edit</a>                                                 
                                                          <form action="{{ route('pegawai.destroy', $P->id) }}" method="POST" class="d-inline">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                          </form>
                                                      </td>
                                                  </tr>
                                              @empty
                                                  <tr>
                                                      <td colspan="10" class="text-center">Tidak ada data pegawai</td>
                                                  </tr>
                                               @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Table Section -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  </div>
</div>

<script>
  function deleteConfirm(e){
      var tomboldelete = document.getElementById('btn-delete')  
      id = e.getAttribute('data-id');

      // const str = 'Hello' + id + 'World';
      var url3 = "{{url('barang/destroy/')}}";
      var url4 = url3.concat("/",id);
      // console.log(url4);

      // console.log(id);
      // var url = "{{url('barang/destroy/"+id+"')}}";
      
      // url = JSON.parse(rul.replace(/"/g,'"'));
      tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

      var pesan = "Data dengan ID <b>"
      var pesan2 = " </b>akan dihapus"
      var res = id;
      document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

      var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
      
      myModal.show();
  
  }
</script>

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
              x
          </button>
      </div>
      <div class="modal-body" id="xid"></div>
      <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
          
      </div>
      </div>
  </div>
</div>   

@endsection
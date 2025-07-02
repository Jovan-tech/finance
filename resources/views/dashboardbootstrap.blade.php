@extends('layoutbootstrap')

@section('konten')

<!--  Main wrapper -->
<div class="body-wrapper">
  <!-- Header -->
  <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">santi</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>

  <!-- Main Content -->
  <div class="container-fluid">
    <!-- Sambutan Welcome -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-light-warning shadow-lg rounded-3 mb-4" style="background: linear-gradient(45deg, #ffd70040, #ff8c0040);">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <h2 class="fw-bold text-danger mb-3">
                  <span></span>Selamat datang! 👩🍳
                </h2>
                <p class="fs-5 text-dark">
                  "Masakan terbaik dimulai dengan bahan terbaik. Mari berikan yang terbaik untuk pelanggan kita hari ini!"
                </p>
              </div>
              <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="Chef Illustration" class="d-none d-md-block" style="width: 200px">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Panorama Masakan -->
    <div class="row">
      <div class="col-lg-8">
        <div class="card shadow-lg rounded-3 overflow-hidden">
          <div id="foodCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1" class="d-block w-100" alt="Special Dish" style="height: 400px; object-fit: cover">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-4">
                  <h3 class="text-warning">Spesial Hari Ini</h3>
                  <p class="fs-5">Nasi Campur Premium dengan 7 Lauk Pilihan</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187" class="d-block w-100" alt="Dessert" style="height: 400px; object-fit: cover">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-4">
                  <h3 class="text-warning">Dessert Istimewa</h3>
                  <p class="fs-5">Es Campur Khas Dadar Bobar dengan Sirup Merah Buatan Sendiri</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe" class="d-block w-100" alt="Appetizer" style="height: 400px; object-fit: cover">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-4">
                  <h3 class="text-warning">Appetizer Baru</h3>
                  <p class="fs-5">Lumpia Udang Crispy dengan Saus Sambal Mangga</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#foodCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#foodCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .welcome-time:after {
    content: "Selamat Pagi";
  }
  
  @media (min-width: 768px) {
    .carousel-item {
      transition: transform 0.6s ease-in-out;
    }
    .carousel-item:hover {
      transform: scale(1.02);
    }
  }
</style>

<script>
  // Update greeting based on time
  const time = new Date().getHours();
  const greeting = time < 10 ? "Selamat Pagi" : 
                   time < 15 ? "Selamat Siang" : 
                   time < 19 ? "Selamat Sore" : "Selamat Malam";
  document.querySelector('.welcome-time').textContent = greeting;
</script>

@endsection
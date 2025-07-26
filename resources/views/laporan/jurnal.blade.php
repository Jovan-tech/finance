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
  
  <!-- Header Perusahaan dan Periode -->
<!-- Header Laporan -->
<div class="container-fluid">
  <div class="text-center mb-4">
      <h4 class="mb-1">Dadarbobar</h4>
      <h5 class="mb-1">Jurnal Umum</h5>
      <p class="mb-0">
        Periode: 
        @if(request('dari') && request('sampai'))
            {{ \Carbon\Carbon::parse(request('dari'))->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse(request('sampai'))->translatedFormat('d F Y') }}
        @else
            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
        @endif
      </p>
  </div>
</div>

  
  <!-- Ringkasan Statistik -->
  <div class="container-fluid mb-4">
    <div class="row">
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.jurnal') }}" class="row mb-4">
                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                </div>
                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success w-100" type="submit">Tampilkan</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Akun</th>
                            <th>Kode Akun</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurnal as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->nama_akun }}</td>
                            <td>{{ $item->kode_akun }}</td>
                            <td class="text-end">{{ number_format($item->debit, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($item->kredit, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data jurnal untuk periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($jurnal->isNotEmpty())
                    <tfoot class="table-secondary">
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th class="text-end">{{ number_format($totalDebit, 0, ',', '.') }}</th>
                            <th class="text-end">{{ number_format($totalKredit, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
            
            <!-- Footer Laporan -->
            <div class="mt-4 text-center text-muted">
                <p class="mb-0">Laporan ini dibuat secara otomatis oleh Sistem Akuntansi Dadarbobar</p>
                <p class="mb-0">Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
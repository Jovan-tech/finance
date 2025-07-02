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
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Laporan Buku Besar</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.buku-besar') }}" class="row mb-4">
                <div class="col-md-8">
                    <label>Nama Akun</label>
                    <select name="nama_akun" class="form-control select2">
                        <option value="">-- Pilih Akun --</option>
                        @foreach($akunList as $akun)
                            <option value="{{ $akun->nama_akun }}" {{ $nama_akun == $akun->nama_akun ? 'selected' : '' }}>
                                {{ $akun->nama_akun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary w-100" type="submit">Tampilkan</button>
                </div>
            </form>

            @if ($nama_akun)
                <h5 class="text-center mb-3">Buku Besar untuk Akun: <strong>{{ $nama_akun }}</strong></h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Akun</th>
                                <th>Keterangan</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $saldo = 0; @endphp
                            @forelse ($jurnal as $item)
                                @php
                                    $saldo += $item->debit - $item->kredit;
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->kode_akun }}</td>
                                    <td>{{ $item->nama_akun }}</td>
                                    <td class="text-end">{{ number_format($item->debit, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($item->kredit, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($saldo, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada transaksi untuk akun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih akun",
            allowClear: true
        });
    });
</script>
@endsection

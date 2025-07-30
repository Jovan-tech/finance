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
    <div class="container-fluid">
        <h3 class="card-title fw-semibold mb-4">Buku Besar</h3>

        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('laporan.buku-besar') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="bulan" class="form-label">Pilih Bulan</label>
                        <input type="month" class="form-control" id="bulan" name="bulan" value="{{ $selectedBulan }}">
                    </div>
                    <div class="col-md-6">
                        <label for="kode_akun" class="form-label">Pilih Akun</label>
                        <select name="kode_akun" id="kode_akun" class="form-select select2">
                            <option value="">-- Pilih Akun --</option>
                            @foreach($akunList as $akun)
                                <option value="{{ $akun->kode_akun }}" {{ $selectedKodeAkun == $akun->kode_akun ? 'selected' : '' }}>
                                    {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($selectedAkun)
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="mb-1">Dadarbobar</h4>
                    <h5 class="mb-1">Buku Besar</h5>
                    <p class="mb-0">Periode {{ \Carbon\Carbon::parse($selectedBulan)->translatedFormat('F Y') }}</p>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <strong>Akun: {{ $selectedAkun->nama_akun }}</strong>
                    <strong>No. Akun: {{ $selectedAkun->kode_akun }}</strong>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">Tanggal</th>
                                <th rowspan="2" class="text-center align-middle">Keterangan</th>
                                <th rowspan="2" class="text-center align-middle">Ref</th>
                                <th rowspan="2" class="text-center align-middle">Debit</th>
                                <th rowspan="2" class="text-center align-middle">Kredit</th>
                                <th colspan="2" class="text-center">Saldo</th>
                            </tr>
                            <tr>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $kodePertama = substr($selectedAkun->kode_akun, 0, 1);
                                $isNormalDebit = in_array($kodePertama, ['1', '5']);
                                $saldo = 0;
                            @endphp

                            
                            <!-- <tr>
                                <td>{{ \Carbon\Carbon::parse($selectedBulan)->startOfMonth()->format('d/m/Y') }}</td>
                                <td colspan="4"><strong>Saldo awal bulan {{ \Carbon\Carbon::parse($selectedBulan)->translatedFormat('F') }}</strong></td>
                                @if ($saldo >= 0)
                                    <td class="text-end">{{ number_format($saldo, 2, ',', '.') }}</td>
                                    <td class="text-end"></td>
                                @else
                                    <td class="text-end"></td>
                                    <td class="text-end">{{ number_format(abs($saldo), 2, ',', '.') }}</td>
                                @endif
                            </tr>  -->

                            @forelse ($jurnal as $item)
                                @php
                                    $debit = $item->debit ?? 0;
                                    $kredit = $item->kredit ?? 0;
                                    
                                    if ($isNormalDebit) {
                                        $saldo += ($debit - $kredit);
                                    } else {
                                        $saldo += ($kredit - $debit);
                                    }
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ $item->keterangan_display }}</td>
                                    <td>{{ $item->ref_display }}</td> 
                                    <td class="text-end">{{ $debit > 0 ? 'Rp. '. number_format($debit, 2, ',', '.') : '' }}</td>
                                    <td class="text-end">{{ $kredit < 0 ? 'Rp. '.number_format(abs($kredit), 2, ',', '.') : '' }}</td>
                                    @if ($saldo >= 0)
                                        <td class="text-end">{{ 'Rp. '. number_format($saldo, 2, ',', '.') }}</td>
                                        <td class="text-end"></td>
                                    @else
                                        <td class="text-end"></td>
                                        <td class="text-end">{{ 'Rp. '.number_format(abs($saldo), 2, ',', '.') }}</td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada transaksi pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    @endsection

    @section('scripts')
    <script>
        // Script Anda tidak perlu diubah
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Akun",
                allowClear: true
            });
        });
    </script>
    @endsection